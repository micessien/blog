@extends('main')

@section('title', " $tag->name Tag")

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>{{$tag->name}} Tag <small>{{$tag->posts()->count()}} Posts</small></h1>
    </div>
    <div class="col-md-2">
        <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-primary pull-right btn-block"
            style="margin-top: 30px">Edit</a>
    </div>
    <div class="col-md-2">
        {{-- Get id data for sweet delete  --}}
        {{-- <input type="hidden" id="actionDeleteVal" value="{{ $tag->id }}" />
        <button type="button" class="btn btn-danger btn-block actionDeleteBtn" style="margin-top:30px">Delete</button>
        --}}

        {!! Form::open(['route'=>['tags.destroy', $tag->id], 'method'=>'DELETE']) !!}
        {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block', 'style'=>'margin-top:30px']) !!}
        {!! Form::close() !!}
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
                        url: "/tags/"+deleteId,
                        data: data,
                        success: function(response) {
                            swal(response.status, {
                                icon: "success",
                            })
                            .then((result) => {
                                location.reload();
                                // location = "/tags"
                            });
                        }
                    });
                }
            });

        })
    });
</script>
@endsection