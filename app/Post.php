<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
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
