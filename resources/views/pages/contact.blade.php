@extends('main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Contact Me</h1>
        <hr>
        <form action="#">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="subject" name="subject" id="subject" class="form-control">
            </div>
            <div class="form-group">
                <label for="message">message:</label>
                <textarea type="message" name="message" id="message"
                    class="form-control">Type your message here</textarea>
            </div>
        </form>

        <input type="submit" value="Send Message" class="btn btn-success">
    </div>
</div> <!-- ent of header .row -->
@endsection