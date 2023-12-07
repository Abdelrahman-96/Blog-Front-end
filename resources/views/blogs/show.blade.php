@extends('layouts.master')
@section('content')
        
<div class="container">
    <div class="card" style="margin-bottom: 20px">
        <img src="{{$blog->image != ''? $blog->image : 'https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg'}}"  style="height: 500px; width: 100%; display: block;"class="card-img-top">  
        <div class="card-body">
            <h5 class="card-title">{{$blog->title}}</h5>
            <p class="card-text"> {!!$blog->description!!} </p>
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
            @if(session('user_id')) 
                <a href="{{route('comments.create', ['blog_id'=>$blog->id])}}" class="btn btn-success">Add Comment</a> 
            @endif
        </div>
    </div>
    @foreach($blog->comments as $comment)
        <form action="{{route('comments.delete', $comment->id)}}" method="post">
        {{csrf_field()}}

        <div class="card" style="margin-bottom: 20px">
        <div class="card-header">{{$comment->name}}</div>
            <div class="card-body">
                <p class="card-text"> {{$comment->mail}} </p>
                <p class="card-text"> {{$comment->url}} </p>
                <p class="card-text"> {{$comment->description}} </p> 
                @if(session('user_id') == $comment->user_id) 
                    <a href="{{route('comments.edit',[$comment->id,'mail' => $comment->mail, 'name' => $comment->name, 'url' => $comment->url, 'description' => $comment->description, 'blog_id' => $blog->id])}}" class="btn btn-primary">Edit</a> 
                    <button type="submit" class="btn btn-danger">Delete</button>              
                @endif
            </div>
        </div>
        </form>
    @endforeach
</div>


@endsection
