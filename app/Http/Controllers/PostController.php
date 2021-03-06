<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use Session;
use Purifier;
use Image;
use Storage;

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
        $posts = Post::orderBy('id', 'desc')->paginate(10);
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
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // validate the data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'body' => 'required',
            'youtube' => 'max:50',
            'dailymotion' => 'max:50',
            'featured_image' => 'sometimes|image'
        ]);
        // store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);
        $post->youtube = $request->youtube;
        $post->dailymotion = $request->dailymotion;
        $post->slug = str_slug($request->title);
        // Save our image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);

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
        // set tags
        $tags = Tag::all();
        $tags2 = [];
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        // return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
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
            'youtube' => 'max:50',
            'dailymotion' => 'max:50',
            'featured_image' => 'image'
        ]);
        // Save the data to the database
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));
        $post->youtube = $request->input('youtube');
        $post->dailymotion = $request->input('dailymotion');
        $post->slug = str_slug($request->input('title'));

        if ($request->hasFile('featured_image')) {
            // Add the new photo
            $image = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldFilename = $post->image;
            // Update the database
            $post->image = $filename;
            // Delete the old photo
            Storage::delete($oldFilename);
        }
        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else{
            $post->tags()->sync(array());
        }
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
        $post = Post::findOrFail($id);
        // $post->tags()->detach();
        // Storage::delete($post->image);
        $post->delete();
        // return response()->json(["status"=>"The blog post was successfully deleted."]);

        Session::flash('success', "The blog post was successfully deleted.");
        return redirect()->route('posts.index');
    }
}
