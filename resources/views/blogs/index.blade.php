@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            Blogs
        </div>
        <div class="card-body">
            @if(session('user_id'))
                <div class="col-md-12">
                    <a href="{{route('blogs.create')}}" class="btn btn-success">Create new Blog</a>
                </div>
            @endif
        </div>
        <div class="container">
            @foreach($blogs->items as $blog)
                <div class="card" style="margin-bottom: 20px">
                <img src="{{$blog->image != ''? $blog->image : 'https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg'}}"  style="height: 500px; width: 100%; display: block;"class="card-img-top">
                    
                <div class="card-body">
                <h5 class="card-title"><a href="{{route('blogs.show', $blog->id)}}">{{$blog->title}}</a></h5>
                <p class="card-text"> {!! mb_strimwidth($blog->description, 0, 1000, "...")!!} </p>
                <div class="row">
                    <div class="col-md-4">
                        <p class="card-text"><small class="text-body-secondary"> {{$blog->date}} ago</small></p>
                    </div>
                    <div class="col-md-4">
                        <p class="card-text"><small class="text-body-secondary"> Comments: {{$blog->comments_count}} </small></p>
                    </div>
                    <div class="col-md-4">
                        <p class="card-text"><small class="text-body-secondary"> Auther: {{$blog->user->name}} </small></p>
                    </div>

                </div>
                    
                </div>
            </div>
            @endforeach
        </div>
       
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="{{$blogs->previous_page_url ? route('blogs.index', ['page'=>$blogs->previous_page_url]) : '#'}}">Previous</a></li>
            <li class="page-item"><a class="page-link" href="{{$blogs->next_page_url ? route('blogs.index', ['page'=>$blogs->next_page_url])  : '#'}}">Next</a></li>
        </ul>
    </nav> 

@endsection
