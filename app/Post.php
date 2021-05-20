<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function getTagsIdArray()
    {
        $id_array = [];

        if (count($this->tags)) {

            foreach ($this->tags as $tag) {
                $id_array[] = $tag->id;
            }
        }

        return $id_array;
    }
}
