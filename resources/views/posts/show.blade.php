@extends('main')

@section('title', 'View Post')

@section('content')
<div class="row">
    <div class="col-md-8">
        <img src="{{asset('images/'.$post->image)}}" alt="{{"Image ".$post->title}}" height="300" width="600">
        <h1>{{ $post->title }}</h1>
        <p class="lead">{!! $post->body !!}</p>
        {{-- Frame youtube --}}
        @empty(!$post->youtube)
        <iframe width="80%" height="315" src="https://www.youtube.com/embed/{{$post->youtube}}" title="{{$post->title}}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        @endempty

        {{-- Frame dailymotion --}}
        @empty(!$post->dailymotion)
        <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;"> <iframe
                style="width:80%;height:100%;position:absolute;left:0px;top:0px;overflow:hidden" frameborder="0"
                type="text/html" src="https://www.dailymotion.com/embed/video/{{$post->dailymotion}}" width="100%"
                height="100%" allowfullscreen allow="autoplay"> </iframe> </div>
        @endempty
        <hr>
        <div class="tags">
            @foreach ($post->tags as $tag)
            <span class="label label-default">{{$tag->name}}</span>
            @endforeach
        </div>
        <div id="backend-comments" style="margin-top: 50px">
            <h3>Comments <small>{{$post->comments->count()}} total</small></h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th width="70px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post->comments as $comment)
                    <tr>
                        <td>{{$comment->name}}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>
                            <a href="{{route('comments.edit', $comment->id)}}" class="btn btn-xs btn-primary"><span
                                    class="glyphicon glyphicon-pencil"></span></a>
                            <a href="{{route('comments.delete', $comment->id)}}" class="btn btn-xs btn-danger"><span
                                    class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <label>Url:</label>
                <p><a href="{{$post->pathBlog()}}">{{$post->pathBlog()}}</a></p>
            </dl>
            <dl class="dl-horizontal">
                <label>Category:</label>
                <p>{{$post->category->name}}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
            </dl>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary
                    btn-block')) !!}
                </div>
                <div class="col-md-6">
                    {{-- Get id data for sweet delete  --}}
                    {{-- <input type="hidden" id="actionDeleteVal" value="{{ $post->id }}" />
                    <button type="button" class="btn btn-danger btn-block actionDeleteBtn">Delete</button> --}}

                    {!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! Html::linkRoute('posts.index', '<< See All Posts', [], array('class'=>'btn
                        btn-default
                        btn-block form-spacing-top')) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.actionDeleteBtn').click(function(e) {
            e.preventDefault();
            // Get id data
            var deleteId = $('#actionDeleteVal').val();
            // alert(deleteId);

            swal({
                title: "Êtes-vous sûr ?",
                text: "Une fois supprimé, vous ne pourrez plus récupérer cette donnée!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Get token
                    var data = {
                        "_token": $('input[name=_token]').val(),
                        "id": deleteId,
                    };
                    $.ajax({
                        type: "DELETE",
                        url: "/posts/"+deleteId,
                        data: data,
                        success: function(response) {
                            swal(response.status, {
                                icon: "success",
                            })
                            .then((result) => {
                                // location.reload();
                                location = "/posts"
                            });
                        }
                    });
                }
            });

        })
    });
</script>
@endsection