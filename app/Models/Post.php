<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at');
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
                $query->whereIN('id', $category)
            )
        );

        $query->when($filters['tag'] ?? false, fn($query, $tag) =>
            $query->whereHas('tags', fn($query) =>
                $query->where('name', $tag)
            )
        );
    }
}
