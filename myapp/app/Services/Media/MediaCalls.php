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

}
