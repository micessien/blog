<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'body', 'slug', 'image', 'category_id', 'youtube', 'dailymotion'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function path()
    {
        return url("/posts/{$this->id}-". Str::slug($this->title));
    }

    public function pathBlog()
    {
        return url("/blog/{$this->id}-". Str::slug($this->title));
    }

    public function pathIdSlugOnly()
    {
        return $this->id . Str::slug($this->title);
    }
}
