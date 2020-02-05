<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllRequest;
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

    public function all_media_paginated(AllRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new MediaCalls();
        return $all_blogs_paginated->all_media_paginated($limit, $offset);
    }

}
