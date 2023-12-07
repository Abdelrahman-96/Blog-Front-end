@extends('layouts.master')
@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            
            <form action="{{route('blogs.store')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="myeditor"></textarea>
                </div>
               
            
                <div class="custom-file">
                    <input type="file" class="custom-file-input" accept="image/*"  id="image" name="media">
                    <label class="custom-file-label" for="inputGroupFile01">Image</label>
                </div>
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