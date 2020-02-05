@extends('layouts.app')

@section('content')
    <h1>Form</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('imageUrl', 'ImageUrl')}}
            {{Form::text('imageUrl', $post->imageUrl, ['class' => 'form-control', 'placeholder' => 'ImageUrl'])}}
        </div>
        <div class="form-group">
            {{Form::label('pdfUrl', 'PdfUrl')}}
            {{Form::text('pdfUrl', $post->pdfUrl, ['class' => 'form-control', 'placeholder' => 'PdfUrl'])}}
        </div>
        <div class="form-group">
            {{Form::label('authorName', 'Author Name')}}
            {{Form::text('authorName', $post->authorName, ['class' => 'form-control', 'placeholder' => 'Author Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('categories', 'Categories')}}
            {{Form::text('categories', $post->categories, ['class' => 'form-control', 'placeholder' => 'Categories'])}}
        </div>
        <div class="form-group">
            {{Form::label('tags', 'Tags')}}
            {{Form::text('tags', $post->tags, ['class' => 'form-control', 'placeholder' => 'Tags'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}   
    {!! Form::close() !!}
@endsection