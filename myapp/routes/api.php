<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

use Illuminate\Support\Facades\Route;

//APIs

Route::get('gettopblog', 'BlogsController@top_story');

Route::get('gettopstory', 'MediaController@top_story');

Route::get('categories', 'BlogsController@categories');

Route::post('suggestedblog', 'BlogsController@suggested_blog');

Route::post('suggestedstory', 'MediaController@suggested_story');

Route::post('uniqueblog', 'BlogsController@unique_blog');

Route::post('uniquestory', 'MediaController@unique_media');

Route::post('allblogs', 'BlogsController@all_blogs_paginated');

Route::post('allstories', 'MediaController@all_media_paginated');

Route::post('getblogforcategory', 'BlogsController@get_blog_for_category');

Route::post('getstoryforcategory', 'MediaController@get_story_for_category');

Route::post('getblogforauthor', 'BlogsController@get_blog_for_author');

Route::post('getstoryforauthor', 'MediaController@get_story_for_author');

Route::post('getblogfortags', 'BlogsController@get_blog_for_tags');

Route::post('getstoryfortags', 'MediaController@get_story_for_tags');


//BLOG CRUD AND FUNCTIONALITY

Route::post('postadd', 'BlogsController@postsadd');

Route::post('populateblog', 'BlogsController@populate_blog');

Route::get('searchblog', 'BlogsController@live_blog_search');

Route::post('getauthors', 'BlogsController@get_authors');

Route::post('getorganization', 'PeoplesController@get_organization');

Route::post('peopleadd', 'PeoplesController@add_people');

Route::post('populatepeople', 'PeoplesController@populate_people');

Route::post('organisationadd', 'OrganisationsController@add_organisation');

Route::post('populateorganisation', 'OrganisationsController@populate_organisation');
