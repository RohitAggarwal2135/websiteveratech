<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Http\Controllers;

use App\Http\Requests\AllRequest;
use App\Http\Requests\GetForAuthorRequest;
use App\Http\Requests\GetForCategoryRequest;
use App\Http\Requests\GetForTagRequest;
use App\Http\Requests\SuggestedRequest;
use App\Http\Requests\UniqueRequest;
use App\Services\Media\MediaCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MediaController extends Controller
{
    /*
     * The function creates a MediaCalls Object and call the "top_story" function.
     */
    public function top_story(Request $request)
    {
        $top_story = new MediaCalls();
        return $top_story->top_story($request);
    }

    /*
     * The function validates and check for 'id' and 'limit' field.
     * The Request is of 'SuggestedRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a MediaCalls Object and call the "get_suggested_story" function.
     */
    public function suggested_story(SuggestedRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $id = $data['id'];
        $limit = $data['limit'];

        $suggested_story = new MediaCalls();
        return $suggested_story->get_suggested_story($id, $limit);
    }

    /*
     * The function validates and check for 'limit' and 'offset' field.
     * The Request is of 'AllRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a MediaCalls Object and call the "all_media_paginated" function.
     */
    public function all_media_paginated(AllRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new MediaCalls();
        return $all_blogs_paginated->all_media_paginated($limit, $offset);
    }

    /*
     * The function validates and check for 'id' field.
     * The Request is of 'UniqueRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a MediaCalls Object and call the "get_unique_story" function.
     */
    public function unique_media(UniqueRequest $request)
    {
        $validator = $request->validated();

        $uid = $request->all()['id'];

        $unique_story = new MediaCalls();
        return $unique_story->get_unique_story($uid);
    }

    /*
     * The function validates and check for 'category', 'limit' and 'offset' field.
     * The Request is of 'GetForCategoryRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a MediaCalls Object and call the "get_story_for_category_paginated" function.
     */
    public function get_story_for_category(GetForCategoryRequest $request)
    {
        $validator = $request->validated();

        $provided_data = $request->all();
        $category = $provided_data['category'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_story_for_category_paginated = new MediaCalls();
        return $get_story_for_category_paginated->get_story_for_category_paginated($category, $limit, $offset);
    }

    /*
     * The function validates and check for 'author'(Author Name), 'limit' and 'offset' field.
     * The Request is of 'GetForAuthorRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a MediaCalls Object and call the "get_story_for_author_paginated" function.
     */
    public function get_story_for_author(GetForAuthorRequest $request)
    {
        $validator = $request->validated();

        $provided_data = $request->all();
        $author_name = $provided_data['author'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_story_for_author_paginated = new MediaCalls();
        return $get_story_for_author_paginated->get_story_for_author_paginated($author_name, $limit, $offset);
    }

    /*
     * The function validates and check for 'tag'(Tag Name. Enter one or comma separated), 'limit' and 'offset' field.
     * The Request is of 'GetForTagRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a MediaCalls Object and call the "get_story_for_tag_paginated" function.
     */
    public function get_story_for_tags(GetForTagRequest $request)
    {
        $validator = $request->validated();

        $provided_data = $request->all();
        $tag = $provided_data['tag'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_story_for_tag_paginated = new MediaCalls();
        return $get_story_for_tag_paginated->get_story_for_tag_paginated($tag, $limit, $offset);
    }
}
