@extends('main')

@section('title', 'Edit Blog Post')

@section('stylesheets')
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
    {!! Form::model($post, ['route'=>['posts.update', $post->id], 'method'=>'PUT', 'files'=>true]) !!}
    <div class="col-md-8">
        {!! Form::label('title', 'Title:', []) !!}
        {!! Form::text('title', null, ['class'=> 'form-control input-lg']) !!}

        {!! Form::label('category_id', 'Category:', ['class'=>'form-spacing-top']) !!}
        {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}

        {!! Form::label('tags', 'Tags:', ['class'=>'form-spacing-top']) !!}
        {!! Form::select('tags[]', $tags, null, ['class'=>'form-control select2-multi', 'multiple'=>'multiple']) !!}

        {!! Form::label('featured_image', 'Update Featured Image: ') !!}
        {!! Form::file('featured_image') !!}

        {!! Form::label('body', 'Body:', ['class'=>'form-spacing-top']) !!}
        {!! Form::textarea('body', null, ['class'=>'form-control', 'id'=>'textarea']) !!}

        {!! Form::label('youtube', 'Code Youtube:') !!}
        {!! Form::text('youtube', null, ['class'=>'form-control', 'maxlength'=>'50', 'placeholder'=>'xjfhn525Q']) !!}

        {!! Form::label('dailymotion', 'Code Dailymotion:') !!}
        {!! Form::text('dailymotion', null, ['class'=>'form-control', 'maxlength'=>'50', 'placeholder'=>'xjfhn525Q'])
        !!}
    </div>
    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    {!! Html::linkRoute('posts.show', 'Cancel', array($post->id, $post->slug), array('class'=>'btn
                    btn-danger
                    btn-block')) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::submit('Save Changes', ['class'=>'btn btn-success btn-block']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2-multi').select2();
});
</script>
@endsection