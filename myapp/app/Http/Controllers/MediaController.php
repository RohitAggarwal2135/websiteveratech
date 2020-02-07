<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllRequest;
use App\Http\Requests\SuggestedRequest;
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
        $request->validated();
        $data = $request->all();
        $id = $data['id'];
        $limit = $data['limit'];

        $suggested_story = new MediaCalls();
        return $suggested_story->get_suggested_story($id, $limit);
    }

    public function all_media_paginated(AllRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new MediaCalls();
        return $all_blogs_paginated->all_media_paginated($limit, $offset);
    }

    public function unique_media(Request $request)
    {
        $uid = $request->all()['id'];

        $unique_story = new MediaCalls();
        return $unique_story->get_unique_story($uid);
    }

    public function get_story_for_category(Request $request)
    {
        $provided_data = $request->all();
        $category = $provided_data['category'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_story_for_category_paginated = new MediaCalls();
        return $get_story_for_category_paginated->get_story_for_category_paginated($category, $limit, $offset);
    }

    public function get_story_for_author(Request $request)
    {
        $provided_data = $request->all();
        $author_name = $provided_data['author'];
        $limit = $provided_data['limit'];
        $offset = $provided_data['offset'];

        $get_story_for_author_paginated = new MediaCalls();
        return $get_story_for_author_paginated->get_story_for_author_paginated($author_name, $limit, $offset);
    }
}
