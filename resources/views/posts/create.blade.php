@extends('main')

@section('title', 'Create New Post')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Create New Post</h1>
        <hr>

        {!! Form::open(['route' => 'posts.store', 'data-parsley-validate'=>'']) !!}
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class'=>'form-control', 'required'=>'', 'maxlength'=>'255']) !!}

        {!! Form::label('category_id', 'Category:') !!}
        <select class="form-control" name="category_id" id="category_id">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{$category->name}}</option>
            @endforeach
        </select>

        {!! Form::label('body', 'Post Body:') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control', 'required'=>'']) !!}

        {!! Form::submit('Create Post', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top: 20px;']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
@endsection