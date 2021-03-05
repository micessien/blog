<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getSingle($id)
    {
        // fetch from the DB based on slug
        $post = Post::find($id);
        // return the view and pass in the post object
        return view('blog.single')->withPost($post);
    }
}
