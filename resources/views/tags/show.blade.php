@extends('main')

@section('title', " $tag->name Tag")

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>{{$tag->name}} Tag <small>{{$tag->posts()->count()}} Posts</small></h1>
    </div>
    <div class="col-md-2 col-md-offset-2">
        <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-primary pull-right btn-block"
            style="margin-top: 30px">Edit</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>tags</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tag->posts as $post)
                <tr>
                    <th>{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>
                        @foreach ($post->tags as $tag)
                        <span class="label label-default">{{$tag->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ $post->path() }}" class="btn btn-default btn-xs">view</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <table>
    </div>
</div>
@endsection