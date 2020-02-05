<?php

use Illuminate\Support\Facades\Route;

Route::resource('blog', 'PostsController');

Route::get('gettopblog', 'BlogsController@top_story');

Route::get('categories', 'BlogsController@categories');

Route::post('suggestedblog', 'BlogsController@suggested_blog');

Route::post('allblogs', 'BlogsController@all_blogs_paginated');

Route::get('gettopmedia', 'MediaController@top_story');

Route::post('allmedia', 'MediaController@all_media_paginated');

Route::get('posts', 'BlogsController@index');

Route::post('postadd', 'BlogsController@postsadd');

Route::post('populateblog', 'BlogsController@populate_blog');

Route::get('searchblog', 'BlogsController@live_blog_search');

Route::post('getauthors', 'BlogsController@get_authors');
