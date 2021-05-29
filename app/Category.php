<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    // When the table name is different to the model name need to be specified
    protected $table = 'categories';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
