@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', " $titleTag")

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <img src="{{asset('images/'.$post->image)}}" alt="{{"Image ".$post->title}}" height="400" width="800">
        <h1>{{$post->title}}</h1>
        <p>{!! $post->body !!}</p>
        {{-- Frame youtube --}}
        @empty(!$post->youtube)
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$post->youtube}}"
            title="{{$post->title}}" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        @endempty

        {{-- Frame dailymotion --}}
        @empty(!$post->dailymotion)
        <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;"> <iframe
                style="width:100%;height:100%;position:absolute;left:0px;top:0px;overflow:hidden" frameborder="0"
                type="text/html" src="https://www.dailymotion.com/embed/video/{{$post->dailymotion}}" width="100%"
                height="100%" allowfullscreen allow="autoplay"> </iframe> </div>
        @endempty
        <hr>
        <p>Posted In: {{ $post->category->name }}</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h3 class="comment-title"><span class="glyphicon glyphicon-comment"></span> {{$post->comments->count()}}
            Comments</h3>
        @foreach ($post->comments as $comment)
        <div class="comment">
            <div class="author-info">
                <img src="{{"https://www.gravatar.com/avatar/". md5(strtolower(trim($post->email))). "?s=50&d=monsterid"}}"
                    alt="user image" class="author-image">
                <div class="author-name">
                    <h4>{{$comment->name}}</h4>
                    <p class="author-time">{{date('F nS, Y - g:iA' ,strtotime($comment->created_at))}}</p>
                </div>
            </div>
            <div class="comment-content">
                {{$comment->comment}}
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px">
        {!! Form::open(['route'=>['comments.store', $post->id], 'method'=>'POST']) !!}
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-md-12">
                {!! Form::label('comment', 'Comment:') !!}
                {!! Form::textarea('comment', null, ['class'=>'form-control', 'rows'=>'5']) !!}

                {!! Form::submit('Add Comment', ['class'=>'btn btn-success btn-block', 'style'=>'margin-top: 20px']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection