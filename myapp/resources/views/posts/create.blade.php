<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<form id="formId">
    <div class="form-group">
        <label> Title: </label>
        <input type="text" class="form-control" name="title" placeholder="Title">
    </div>

    <div class="form-group">
        <label> Body: </label>
        <input type="text" class="form-control" name="content" placeholder="Content">
    </div>

    <div class="form-group">
        <label> Image Url: </label>
        <input type="text" class="form-control" name="imageUrl" placeholder="Image URL">
    </div>

    <div class="form-group">
        <label> Pdf Url: </label>
        <input type="text" class="form-control" name="pdfUrl" placeholder="pdf URL">
    </div>

    <div class="form-group">
        <label> Author Name: </label>
        <input type="text" class="form-control" name="authorName" placeholder="Author Name">
    </div>

    <div class="form-group">
        <label> Categories: </label>
        <input type="text" class="form-control" name="categories" placeholder="Categories">
    </div>

    <div class="form-group">
        <label> Tags: </label>
        <input type="text" class="form-control" name="tags" placeholder="Tags">
    </div>

    <button type="submit" name="submit" class="btn btn-primary" onclick="submitFunction();">Submit</button>
</form>

<div id="test"></div>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
<script src="../../js/dashboard.js"></script>
</body>
</html>
