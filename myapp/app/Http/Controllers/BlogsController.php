<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Http\Controllers;

use App\Constants\ConstantValues;

header(ConstantValues::HEADER_NAME_CORS . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::HEADER_VALUE_ALL_OPERATOR);

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

    /*
     * The function creates a BlogCalls Object and call the "top_story" function.
     */
    public function top_story(Request $request)
    {
        $top_story = new BlogCalls();
        return $top_story->top_story($request);
    }

    /*
     * The function creates a BlogCalls Object and call the "categories" function.
     */
    public function categories(Request $request)
    {
        $category = new BlogCalls();
        return $category->categories($request);
    }

    /*
     * The function validates and check for 'id' and 'limit' field.
     * The Request is of 'SuggestedRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "suggested_blog" function.
     */
    public function suggested_blog(SuggestedRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $id = $data['id'];
        $limit = $data['limit'];

        $suggested_blog = new BlogCalls();
        return $suggested_blog->suggested_blog($id, $limit);
    }

    /*
     * The function validates and check for 'limit' and 'offset' field.
     * The Request is of 'AllRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "all_blogs_paginated" function.
     */
    public function all_blogs_paginated(AllRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new BlogCalls();
        return $all_blogs_paginated->all_blogs_paginated($limit, $offset);
    }

    /*
     * The function validates and check for 'id' field.
     * The Request is of 'UniqueRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "unique_blog" function.
     */
    public function unique_blog(UniqueRequest $request)
    {
        $validator = $request->validated();

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'id'};

        $unique_blog = new BlogCalls();
        return $unique_blog->unique_blog($uid);
    }

    /*
     * The function validates and check for 'category', 'limit' and 'offset' field.
     * The Request is of 'GetForCategoryRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "get_blog_for_category_paginated" function.
     */
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

    /*
     * The function validates and check for 'author'(Author Name), 'limit' and 'offset' field.
     * The Request is of 'GetForAuthorRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "get_blog_for_author_paginated" function.
     */
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

    /*
     * The function validates and check for 'tag'(Tag Name. Enter one or comma separated), 'limit' and 'offset' field.
     * The Request is of 'GetForTagRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "get_blog_for_tag_paginated" function.
     */
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

    /*
     * The 'postsadd' function is called to add new blog or update a existing one.
     * The function validates and check for 'title' and 'author' field.
     * The Request is of 'PostAddRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "add_post" function.
     */
    public function postsadd(PostAddRequest $request)
    {
        $validator = $request->validated();

        $blog_json = json_encode($request->all());
        $add_post = new BlogCalls();
        return $add_post->add_post($blog_json);
    }

    /*
     * The 'populate_blog' function is called to populate the data of a existing blog.
     * The function validates and check for 'uid' field.
     * The Request is of 'PopulateRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a BlogCalls Object and call the "populate_blog" function.
     */
    public function populate_blog(PopulateRequest $request)
    {
        $validator = $request->validated();

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};

        $blog_populate = new BlogCalls();
        return $blog_populate->populate_blog($uid);
    }

    /*
     * The 'live_blog_search' function is called to live search the data in existing blogs.
     * It creates a BlogCalls Object and call the "live_search_blog" function.
     */
    public function live_blog_search(Request $request)
    {
        $live_blog_search_result = new BlogCalls();
        return $live_blog_search_result->live_search_blog($request);
    }

    /*
     * The 'get_authors' function is called to Get authors to complete in the author Name AutoEasyComplete DropDown.
     * It creates a BlogCalls Object and call the "author_names_from_people_table" function.
     */
    public function get_authors(Request $request)
    {
        $author_names_for_autocomplete = new BlogCalls();
        return $author_names_for_autocomplete->author_names_from_people_table($request);
    }
}
