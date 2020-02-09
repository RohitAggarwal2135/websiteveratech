<?php

namespace App\Http\Controllers;

use App\Constants\ConstantValues;
use App\Http\Requests\AllRequest;
use App\Http\Requests\SuggestedRequest;
use App\Services\Media\MediaCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function top_story(Request $request)
    {
        $top_story = new MediaCalls();
        return $top_story->top_story($request);
    }

    public function suggested_story(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_ID => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::FIELD_NAME_LIMIT_RANGE,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $data = $request->all();
        $id = $data['id'];
        $limit = $data['limit'];

        $suggested_story = new MediaCalls();
        return $suggested_story->get_suggested_story($id, $limit);
    }

    public function all_media_paginated(Request $request)
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

        $all_blogs_paginated = new MediaCalls();
        return $all_blogs_paginated->all_media_paginated($limit, $offset);
    }

    public function unique_media(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_ID => ConstantValues::FIELD_NAME_REQUIRED,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $uid = $request->all()['id'];

        $unique_story = new MediaCalls();
        return $unique_story->get_unique_story($uid);
    }

    public function get_story_for_category(Request $request)
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

        $get_story_for_category_paginated = new MediaCalls();
        return $get_story_for_category_paginated->get_story_for_category_paginated($category, $limit, $offset);
    }

    public function get_story_for_author(Request $request)
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

        $get_story_for_author_paginated = new MediaCalls();
        return $get_story_for_author_paginated->get_story_for_author_paginated($author_name, $limit, $offset);
    }

    public function get_story_for_tags(Request $request)
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

        $get_story_for_tag_paginated = new MediaCalls();
        return $get_story_for_tag_paginated->get_story_for_tag_paginated($tag, $limit, $offset);
    }
}
