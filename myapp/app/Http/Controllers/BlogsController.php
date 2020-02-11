<?php

namespace App\Http\Controllers;

header("Access-Control-Allow-Origin: *");

use App\Http\Requests\AllRequest;
use App\Http\Requests\GetForAuthorRequest;
use App\Http\Requests\GetForCategoryRequest;
use App\Http\Requests\GetForTagRequest;
use App\Http\Requests\PopulateRequest;
use App\Http\Requests\PostAddRequest;
use App\Http\Requests\SuggestedRequest;
use App\Http\Requests\UniqueRequest;
use App\Services\Blog\BlogCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlogsController extends Controller
{

//    APIs
    public function index(Request $request)
    {
        return view('posts.create');
    }

    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function top_story(Request $request)
    {
        $top_story = new BlogCalls();
        return $top_story->top_story($request);
    }

    public function categories(Request $request)
    {
        $category = new BlogCalls();
        return $category->categories($request);
    }

    public function suggested_blog(SuggestedRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $id = $data['id'];
        $limit = $data['limit'];

        $suggested_blog = new BlogCalls();
        return $suggested_blog->suggested_blog($id, $limit);
    }

    public function all_blogs_paginated(AllRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new BlogCalls();
        return $all_blogs_paginated->all_blogs_paginated($limit, $offset);
    }

    public function unique_blog(UniqueRequest $request)
    {
        $validator = $request->validated();

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'id'};

        $unique_blog = new BlogCalls();
        return $unique_blog->unique_blog($uid);
    }

    public function get_blog_for_category(GetForCategoryRequest $request)
    {
        $validator = $request->validated();

        $provided_data = $request->all();
        $category = $provided_data['category'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_blog_for_category_paginated = new BlogCalls();
        return $get_blog_for_category_paginated->get_blog_for_category_paginated($category, $limit, $offset);
    }

    public function get_blog_for_author(GetForAuthorRequest $request)
    {
        $validator = $request->validated();

        $provided_data = $request->all();
        $author_name = $provided_data['author'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_blog_for_author_paginated = new BlogCalls();
        return $get_blog_for_author_paginated->get_blog_for_author_paginated($author_name, $limit, $offset);
    }

    public function get_blog_for_tags(GetForTagRequest $request)
    {
        $validator = $request->validated();

        $provided_data = $request->all();
        $tag = $provided_data['tag'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_blog_for_tag_paginated = new BlogCalls();
        return $get_blog_for_tag_paginated->get_blog_for_tag_paginated($tag, $limit, $offset);
    }


//    BLOG CRUD AND FUNCTIONALITY


    public function postsadd(PostAddRequest $request)
    {
        $validator = $request->validated();

        $blog_json = json_encode($request->all());
        $add_post = new BlogCalls();
        return $add_post->add_post($blog_json);
    }

    public function populate_blog(PopulateRequest $request)
    {
        $validator = $request->validated();

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};

        $blog_populate = new BlogCalls();
        return $blog_populate->populate_blog($uid);
    }

    public function live_blog_search(Request $request)
    {
        $live_blog_search_result = new BlogCalls();
        return $live_blog_search_result->live_search_blog(request());
    }

    public function get_authors(Request $request)
    {
        $author_names_for_autocomplete = new BlogCalls();
        return $author_names_for_autocomplete->author_names_from_people_table($request);
    }
}
