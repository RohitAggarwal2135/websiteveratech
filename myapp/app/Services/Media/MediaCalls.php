<?php

namespace App\Services\Media;

use App\Constants\DBValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaCalls
{
    const TOP_PRIORITY_VALUE = 0;

    public function top_story(Request $request)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_MEDIA)->select([DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_TABLE_MEDIA_PUBLISHED_ON_DATE, DBValues::DB_TABLE_MEDIA_URL_BACKGROUND_PIC, DBValues::DB_TABLE_MEDIA_TAGS, DBValues::DB_TABLE_MEDIA__URL_CONTENT, DBValues::DB_TABLE_MEDIA_URL_PDF, DBValues::DB_TABLE_MEDIA_MEDIA_NAME, DBValues::DB_TABLE_MEDIA_HEADLINE])->where(DBValues::DB_TABLE_MEDIA_PRIORITY, DBValues::DB_OPERATOR_EQUAL_TO, MediaCalls::TOP_PRIORITY_VALUE)->get());
    }

    public function all_media_paginated($limit, $offset)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_MEDIA)->select([DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_TABLE_MEDIA_PUBLISHED_ON_DATE, DBValues::DB_TABLE_MEDIA_URL_BACKGROUND_PIC, DBValues::DB_TABLE_MEDIA_TAGS, DBValues::DB_TABLE_MEDIA__URL_CONTENT, DBValues::DB_TABLE_MEDIA_URL_PDF, DBValues::DB_TABLE_MEDIA_MEDIA_NAME, DBValues::DB_TABLE_MEDIA_HEADLINE])->limit($limit)->offset($offset)->get());
    }

    public function get_unique_story($uid)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_MEDIA)->where(DBValues::DB_TABLE_MEDIA_UID, DBValues::DB_OPERATOR_EQUAL_TO, $uid)->select([DBValues::DB_OPERATOR_SELECT_ALL])->get());
    }

    public function get_suggested_story($id, $limit)
    {
        $current_author_json = DB::table(DBValues::DB_TABLE_NAME_MEDIA)
            ->where(DBValues::DB_TABLE_MEDIA_UID, DBValues::DB_OPERATOR_EQUAL_TO, $id)
            ->select([DBValues::DB_TABLE_MEDIA_AUTHOR_NAME])
            ->get();
        $current_author_string = json_decode(json_encode($current_author_json), true)[0][DBValues::DB_TABLE_MEDIA_AUTHOR_NAME];
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_MEDIA)->where(DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_OPERATOR_EQUAL_TO, $current_author_string)->where(DBValues::DB_TABLE_MEDIA_UID, DBValues::DB_OPERATOR_NOT_EQUAL_TO, $id)->select([DBValues::DB_OPERATOR_SELECT_ALL])->limit($limit)->get());
    }

    public function get_story_for_category_paginated($category, $limit, $offset)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_MEDIA)->where(DBValues::DB_TABLE_MEDIA_CATEGORY, DBValues::DB_OPERATOR_EQUAL_TO, $category)->select([DBValues::DB_OPERATOR_SELECT_ALL])->limit($limit)->offset($offset)->get());
    }

    public function get_story_for_author_paginated($author_name, $limit, $offset)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_MEDIA)->where(DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_OPERATOR_EQUAL_TO, $author_name)->select([DBValues::DB_OPERATOR_SELECT_ALL])->limit($limit)->offset($offset)->get());
    }
}
