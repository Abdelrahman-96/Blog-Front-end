@extends('layouts.master')
@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            
            <form action="{{route('comments.store')}}" method="post" enctype="multipart/form-data">
                @include('comments.fields')

                {{csrf_field()}}
                <br> <br>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>    
    <script>
    window.onload = function() {
        CKEDITOR.replace('myeditor');
    };
</script>
@endsection