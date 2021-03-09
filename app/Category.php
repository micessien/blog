<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // When the table name is different to the model name need to be specified
    protected $table = 'categories';

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
