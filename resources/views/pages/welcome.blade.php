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
        <div class="post">
            <h3>Post tiltle</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo officia, ducimus nobis in eius
                voluptatem quaerat eligendi dolorem rerum dicta, maiores quis explicabo harum dolorum amet
                impedit facere velit corporis!</p>
            <a href="#" class="btn btn-primary">Read More</a>
        </div>
        <div class="post">
            <h3>Post tiltle</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo officia, ducimus nobis in eius
                voluptatem quaerat eligendi dolorem rerum dicta, maiores quis explicabo harum dolorum amet
                impedit facere velit corporis!</p>
            <a href="#" class="btn btn-primary">Read More</a>
        </div>
        <div class="post">
            <h3>Post tiltle</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo officia, ducimus nobis in eius
                voluptatem quaerat eligendi dolorem rerum dicta, maiores quis explicabo harum dolorum amet
                impedit facere velit corporis!</p>
            <a href="#" class="btn btn-primary">Read More</a>
        </div>
        <div class="post">
            <h3>Post tiltle</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo officia, ducimus nobis in eius
                voluptatem quaerat eligendi dolorem rerum dicta, maiores quis explicabo harum dolorum amet
                impedit facere velit corporis!</p>
            <a href="#" class="btn btn-primary">Read More</a>
        </div>
    </div>
    <div class="col-md-3 col-md-offset-1">Sidebar</div>
</div>
@endsection