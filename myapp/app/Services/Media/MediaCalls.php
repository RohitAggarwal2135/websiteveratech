<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Services\Media;

use App\Constants\DBValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaCalls
{
    const TOP_PRIORITY_VALUE = 0; //The Blog with this value is top priority Blog.

    /*
     * The 'top_story' function returns the top priority story present in the database.
     */
    public function top_story(Request $request)
    {
        return response()->json(
            DB::table(DBValues::DB_TABLE_NAME_MEDIA)
                ->select([DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_TABLE_MEDIA_PUBLISHED_ON_DATE, DBValues::DB_TABLE_MEDIA_URL_BACKGROUND_PIC, DBValues::DB_TABLE_MEDIA_TAGS, DBValues::DB_TABLE_MEDIA__URL_CONTENT, DBValues::DB_TABLE_MEDIA_URL_PDF, DBValues::DB_TABLE_MEDIA_MEDIA_NAME, DBValues::DB_TABLE_MEDIA_HEADLINE])
                ->where(DBValues::DB_TABLE_MEDIA_PRIORITY, DBValues::DB_OPERATOR_EQUAL_TO, MediaCalls::TOP_PRIORITY_VALUE)
                ->get());
    }

    /*
     * The 'get_suggested_story' function returns the suggested story for the current story uid.
     * First, it gets the author name from the media database for the given story uid.
     * It gets the 'n' number of (limit value) stories from the same author excluding the current story.
     * It gets 'id' and 'limit' value.
     */
    public function get_suggested_story($id, $limit)
    {
        $current_author_json = DB::table(DBValues::DB_TABLE_NAME_MEDIA)
            ->where(DBValues::DB_TABLE_MEDIA_UID, DBValues::DB_OPERATOR_EQUAL_TO, $id)
            ->select([DBValues::DB_TABLE_MEDIA_AUTHOR_NAME])
            ->get();

        $current_author_string = json_decode(json_encode($current_author_json), true)[0][DBValues::DB_TABLE_MEDIA_AUTHOR_NAME];
        return response()->json(
            DB::table(DBValues::DB_TABLE_NAME_MEDIA)
                ->where(DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_OPERATOR_EQUAL_TO, $current_author_string)
                ->where(DBValues::DB_TABLE_MEDIA_UID, DBValues::DB_OPERATOR_NOT_EQUAL_TO, $id)
                ->select([DBValues::DB_OPERATOR_SELECT_ALL])
                ->limit($limit)
                ->get());
    }

    /*
     * The 'all_media_paginated' function returns all the stories in paginated fashion.
     * It gets 'limit' and 'offset' value.
     */
    public function all_media_paginated($limit, $offset)
    {
        return response()->json(
            DB::table(DBValues::DB_TABLE_NAME_MEDIA)
                ->select([DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_TABLE_MEDIA_PUBLISHED_ON_DATE, DBValues::DB_TABLE_MEDIA_URL_BACKGROUND_PIC, DBValues::DB_TABLE_MEDIA_TAGS, DBValues::DB_TABLE_MEDIA__URL_CONTENT, DBValues::DB_TABLE_MEDIA_URL_PDF, DBValues::DB_TABLE_MEDIA_MEDIA_NAME, DBValues::DB_TABLE_MEDIA_HEADLINE])
                ->limit($limit)
                ->offset($offset)
                ->get());
    }

    /*
     * The 'get_unique_story' function returns a unique Blog
     * corresponding to the provided uid.
     * It gets 'uid' value of the blog needed.
     */
    public function get_unique_story($uid)
    {
        return response()->json(
            DB::table(DBValues::DB_TABLE_NAME_MEDIA)
                ->where(DBValues::DB_TABLE_MEDIA_UID, DBValues::DB_OPERATOR_EQUAL_TO, $uid)
                ->select([DBValues::DB_OPERATOR_SELECT_ALL])
                ->get());
    }

    /*
     * The 'get_story_for_category_paginated' function returns stories in paginated fashion
     * corresponding to the provided category.
     * It gets 'category', 'limit' and 'offset' value of the story needed.
     */
    public function get_story_for_category_paginated($category, $limit, $offset)
    {
        return response()->json(
            DB::table(DBValues::DB_TABLE_NAME_MEDIA)
                ->where(DBValues::DB_TABLE_MEDIA_CATEGORY, DBValues::DB_OPERATOR_EQUAL_TO, $category)
                ->select([DBValues::DB_OPERATOR_SELECT_ALL])
                ->limit($limit)
                ->offset($offset)
                ->get());
    }

    /*
     * The 'get_story_for_author_paginated' function returns stories in paginated fashion
     * corresponding to the provided author name.
     * It gets 'author name', 'limit' and 'offset' value of the story needed.
     */
    public function get_story_for_author_paginated($author_name, $limit, $offset)
    {
        return response()->json(
            DB::table(DBValues::DB_TABLE_NAME_MEDIA)
                ->where(DBValues::DB_TABLE_MEDIA_AUTHOR_NAME, DBValues::DB_OPERATOR_EQUAL_TO, $author_name)
                ->select([DBValues::DB_OPERATOR_SELECT_ALL])
                ->limit($limit)
                ->offset($offset)
                ->get());
    }

    /*
     * The 'get_story_for_tag_paginated' function returns stories in paginated fashion
     * corresponding to the provided tag name(one or comma(,) separated.
     * It gets 'tag name', 'limit' and 'offset' value of the story needed.
     */
    public function get_story_for_tag_paginated($tag, $limit, $offset)
    {
        return response()->json(
            DB::table(DBValues::DB_TABLE_NAME_MEDIA)
                ->where(DBValues::DB_TABLE_MEDIA_TAGS, DBValues::DB_OPERATOR_LIKE, DBValues::DB_OPERATOR_LIKE_PERCENTAGE . $tag . DBValues::DB_OPERATOR_LIKE_PERCENTAGE)
                ->select([DBValues::DB_OPERATOR_SELECT_ALL])
                ->limit($limit)
                ->offset($offset)
                ->get());
    }
}
