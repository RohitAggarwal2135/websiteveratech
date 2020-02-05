@extends('layouts.app')

@section('content')
    <a href='/posts' class='btn btn-primary'>Go Back</a>
    <h1>{{$post->title}}</h1>
    <h1>
        {!!$post->body!!}
    </h1>
    <small> Written on: {{$post->created_at}}</small>    
    <h2> Written By: {{$post->authorName}}</h2>
    <h2> Categories: {{$post->categories}}</h2>
    <h2> Tags: {{$post->tags}}</h2>
    <h2> Pdf Url: {{$post->pdfUrl}}</h2>
    <h2> Image Url: {{$post->imageUrl}}</h2>

    <a href="/posts/{{$post->id}}/edit" class="btn btn-default btn-lg">Edit</a>

    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
@endsection