<?php

namespace App\Http\Controllers;

header("Access-Control-Allow-Origin: *");

use App\Constants\ConstantValues;
use App\Services\Blog\BlogCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

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

    public function suggested_blog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::FIELD_NAME_LIMIT_RANGE,
            ConstantValues::FIELD_NAME_ID => ConstantValues::FIELD_NAME_REQUIRED,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $data = $request->all();
        $id = $data['id'];
        $limit = $data['limit'];

        $suggested_blog = new BlogCalls();
        return $suggested_blog->suggested_blog($id, $limit);
    }

    public function all_blogs_paginated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::FIELD_NAME_LIMIT_RANGE,
            ConstantValues::FIELD_NAME_OFFSET => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new BlogCalls();
        return $all_blogs_paginated->all_blogs_paginated($limit, $offset);
    }

    public function unique_blog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_ID => ConstantValues::FIELD_NAME_REQUIRED
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'id'};

        $unique_blog = new BlogCalls();
        return $unique_blog->unique_blog($uid);
    }

    public function get_blog_for_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_CATEGORY => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::FIELD_NAME_LIMIT_RANGE,
            ConstantValues::FIELD_NAME_OFFSET => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $provided_data = $request->all();
        $category = $provided_data['category'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_blog_for_category_paginated = new BlogCalls();
        return $get_blog_for_category_paginated->get_blog_for_category_paginated($category, $limit, $offset);
    }

    public function get_blog_for_author(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_AUTHOR => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::FIELD_NAME_LIMIT_RANGE,
            ConstantValues::FIELD_NAME_OFFSET => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $provided_data = $request->all();
        $author_name = $provided_data['author'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_blog_for_author_paginated = new BlogCalls();
        return $get_blog_for_author_paginated->get_blog_for_author_paginated($author_name, $limit, $offset);
    }

    public function get_blog_for_tags(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_TAG => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::FIELD_NAME_LIMIT_RANGE,
            ConstantValues::FIELD_NAME_OFFSET => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $provided_data = $request->all();
        $tag = $provided_data['tag'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_blog_for_tag_paginated = new BlogCalls();
        return $get_blog_for_tag_paginated->get_blog_for_tag_paginated($tag, $limit, $offset);
    }


//    BLOG CRUD AND FUNCTIONALITY


    public function postsadd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_TITLE => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_AUTHOR => ConstantValues::FIELD_NAME_REQUIRED,

        ]);
        if ($validator->fails()) {
            $validation_failed_response = $validator->messages();
            $title_response_boolean = isset(json_decode(json_encode($validation_failed_response), true)['title']);
            $author_response_boolean = isset(json_decode(json_encode($validation_failed_response), true)['author']);

            if (!$title_response_boolean && $author_response_boolean) {
//                print_r(get_class($validation_failed_response));
                $validation_failed_response->add('title', $request->all()['title']);
            }

            if ($title_response_boolean && !$author_response_boolean) {
//                print_r(get_class($validation_failed_response));
                $validation_failed_response->add('author', $request->all()['author']);
            }

            return response()->json($validation_failed_response, 200);
        }

        $blog_json = json_encode($request->all());
        $add_post = new BlogCalls();
        return $add_post->add_post($blog_json);
    }

    public function populate_blog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_UID => ConstantValues::FIELD_NAME_REQUIRED,

        ]);
        if ($validator->fails()) {
            $validation_failed_response = $validator->messages();
            return response()->json($validation_failed_response, 200);
        }

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
