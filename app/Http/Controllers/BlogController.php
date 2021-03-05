<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getIndex()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($id)
    {
        // fetch from the DB based on slug
        $post = Post::find($id);
        // return the view and pass in the post object
        return view('blog.single')->withPost($post);
    }
}
