@extends('layouts.app')

@section('content')
    <center>
        <h1>Post</h1>
    </center>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <h1 style="color:red;">Json object: </h1>
                    <p style="font-size: 1.5em;"> {{$post}}</p>
                <br><br>
                <h3 style="color:red;">ID:  </h3> <h3> {{$post->id}}</h3>
            <h3 style="color:red;">Title:  </h3> <h3> <a href='/posts/{{$post->id}}'>{{$post->title}} </a></h3>
                {{-- <h3 style="color:red;"> Blog Body: </h3> <h3> {!!$post->body!!}</h3>
                <h3 style="color:red;">Author: </h3> <h3>  {{$post->authorName}}</h3>
                <h3 style="color:red;">Image Url: </h3> <h3>  {{$post->imageUrl}}</h3>
                <h3 style="color:red;">Pdf Url: </h3> <h3>  {{$post->pdfUrl}}</h3>
                <h3 style="color:red;">Categories: </h3> <h3>  {{$post->categories}}</h3>
                <h3 style="color:red;">Tags: </h3> <h3> {{$post->tags}}</h3> --}}
            </div>
            <div style="background-color:black;color:black;height:2%;width:100%;">Veratech</div>
        @endforeach
        {{$posts->links()}} 
    @else
        <p>No posts found</p>
    @endif
@endsection