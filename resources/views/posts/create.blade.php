@extends('main')

@section('title', 'Create New Post')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
<script src="https://cdn.tiny.cloud/1/tfjka7vcrbq1czuhr1t7117gcp5dy9upwrhfcxedfarfovh6/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: '#textarea',
      plugins: 'link code',
      menubar: false
    });
</script>
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

        {!! Form::label('tags', 'Tags:') !!}
        <select class="form-control select2-multi" name="tags[]" id="tags" multiple="multiple">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{$tag->name}}</option>
            @endforeach
        </select>

        {!! Form::label('body', 'Post Body:') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control', 'required'=>'', 'id'=>'textarea']) !!}

        {!! Form::submit('Create Post', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top: 20px;']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2-multi').select2();
});
</script>
@endsection