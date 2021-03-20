@extends('main')

@section('title', ' DELETE COMMENT ?')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h3>DELETE THIS COMMENT</h3>
        <p>
            <strong>Name: </strong> {{$comment->name}} <br>
            <strong>Email: </strong> {{$comment->email}} <br>
            <strong>Comment: </strong> {{$comment->comment}}
        </p>

        {!! Form::open(['route'=>['comments.destroy', $comment->id], 'method'=>'DELETE']) !!}
        {!! Form::submit('YES DELETE THIS COMMENT', ['class'=>'btn btn-lg btn-danger btn-block',
        'style'=>'margin-top:30px']) !!}
        {!! Form::close() !!}

        <a href="{{$comment->post->path()}}" class="btn btn-block btn-primary" style="margin-top: 15px">NO PLEASE</a>
    </div>
</div>
@endsection