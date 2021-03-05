@extends('main')

@section('title', 'Homepage')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>Hello, Laravel Blog!</h1>
            <p>Thank you for visiting</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular post</a></p>
        </div>
    </div>
</div> <!-- ent of header .row -->

<div class="row">
    <div class="col-md-8">
        @foreach ($posts as $post)
        <div class="post">
            <h3>{{ $post->title }}</h3>
            <p>{{ substr($post->body, 0, 300) }} {{strlen($post->body) > 300 ? "..." : ""}}</p>
            <a href="{{$post->pathBlog()}}" class="btn btn-primary">Read More</a>
        </div>
        @endforeach
    </div>
    <div class="col-md-3 col-md-offset-1">Sidebar</div>
</div>
@endsection