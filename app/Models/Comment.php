<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeComment($query)
    {
        $query->whereNull('parent_id');
    }
}
