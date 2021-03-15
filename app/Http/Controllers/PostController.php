<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create variable and store all the blog post in it from the database
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        // return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'body' => 'required',
        ]);
        // store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        $post->slug = str_slug($request->title);
        $post->save();

        Session::flash('success', "The blog post was successfully save!");
        // redirect to another page
        return redirect()->route('posts.show', [$post->id, $post->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find a post in the database and save as var
        $post = Post::find($id);
        // set categories
        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }
        // dd($cats);
        // return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'body' => 'required',
        ]);
        // Save the data to the database
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');
        $post->slug = str_slug($request->input('title'));
        $post->save();
        // Set flash data with success message
        Session::flash('success', "The blog post was successfully update.");
        // redirect with flash data to posts.show
        return redirect()->route('posts.show', [$post->id, $post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        Session::flash('success', "The blog post was successfully deleted.");
        return redirect()->route('posts.index');
    }
}
