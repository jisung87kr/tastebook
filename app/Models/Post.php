<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['user', 'category', 'comments', 'tags'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->withTrashed();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopePublishedInAdmin($query)
    {
        if(!auth()->user()){
            return $this->scopePublished($query);
        }

        if(auth()->user()->can('view own unpublished posts')){
            return $query->whereNotNull('published_at')->orWhere('user_id', auth()->user()->id);
        }

        if(auth()->user()->can('view all unpublished posts')){
            return $query->whereNotNull('published_at');
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
            $query->where('subject', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['except'] ?? false, function($query, $except){
            $excepts = array_map('trim', explode(',', $except));
            foreach ($excepts as $index => $except) {
                $query->where(fn($query) =>
                    $query->where('subject', 'not like', '%' . $except . '%')
                        ->Where('content', 'not like', '%' . $except . '%')
                    );
                }
            }
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query) =>
                $query->where('id', $category)
            )
        );

        $query->when($filters['tag'] ?? false, fn($query, $tag) =>
            $query->whereHas('tags', fn($query) =>
                $query->where('name', $tag)
            )
        );
    }

    public function getThumbnailUrl(){
        $image = $this->attachments->whereIn('mineType', ['image/png', 'image/jpg', 'image/jpge', 'image/gif'])->first();
        if($image){
            return Storage::url($image->path);
        }
        return 'https://via.placeholder.com/300x300';
    }

}
