<?php

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
    public function top_story(Request $request)
    {
        $top_story = new MediaCalls();
        return $top_story->top_story($request);
    }

    public function suggested_story(SuggestedRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $id = $data['id'];
        $limit = $data['limit'];

        $suggested_story = new MediaCalls();
        return $suggested_story->get_suggested_story($id, $limit);
    }

    public function all_media_paginated(AllRequest $request)
    {
        $validator = $request->validated();

        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new MediaCalls();
        return $all_blogs_paginated->all_media_paginated($limit, $offset);
    }

    public function unique_media(UniqueRequest $request)
    {
        $validator = $request->validated();

        $uid = $request->all()['id'];

        $unique_story = new MediaCalls();
        return $unique_story->get_unique_story($uid);
    }

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
