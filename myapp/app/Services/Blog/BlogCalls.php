<?php

namespace App\Services\Blog;
header("Access-Control-Allow-Origin : *");
use App\Constants\ConstantValues;
use App\Constants\DBValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class BlogCalls
{
    const TOP_PRIORITY_VALUE = 0;

    public function top_story(Request $request)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_BLOG)->select([DBValues::DB_TABLE_BLOG_AUTHOR, DBValues::DB_TABLE_BLOG_PUBLISHED_DATE, DBValues::DB_TABLE_BLOG_URL_IMAGE, DBValues::DB_TABLE_BLOG_TAGS, DBValues::DB_TABLE_BLOG_CONTENT, DBValues::DB_TABLE_BLOG_DESCRIPTION, DBValues::DB_TABLE_BLOG_FEATURED])->where(DBValues::DB_TABLE_BLOG_PRIORITY, DBValues::DB_OPERATOR_EQUAL_TO, BlogCalls::TOP_PRIORITY_VALUE)->get());
    }

    public function categories(Request $request)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_BLOG)->select([DBValues::DB_TABLE_BLOG_CATEGORY])->distinct()->get());
    }

    public function suggested_blog($id)
    {
        $current_author_json = DB::table(DBValues::DB_TABLE_NAME_BLOG)->select([DBValues::DB_TABLE_BLOG_AUTHOR])->where(DBValues::DB_TABLE_BLOG_UID, DBValues::DB_OPERATOR_EQUAL_TO, $id)->get();
        $current_author_string = json_decode(json_encode($current_author_json), true)[0][DBValues::DB_TABLE_BLOG_AUTHOR];
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_BLOG)->select([DBValues::DB_OPERATOR_SELECT_ALL])->where(DBValues::DB_TABLE_BLOG_AUTHOR, DBValues::DB_OPERATOR_EQUAL_TO, $current_author_string)->where(DBValues::DB_TABLE_BLOG_UID, DBValues::DB_OPERATOR_NOT_EQUAL_TO, $id)->get());
    }

    public function all_blogs_paginated($limit, $offset)
    {
        return response()->json(DB::table(DBValues::DB_TABLE_NAME_BLOG)->select([DBValues::DB_TABLE_BLOG_AUTHOR, DBValues::DB_TABLE_BLOG_PUBLISHED_DATE, DBValues::DB_TABLE_BLOG_URL_IMAGE, DBValues::DB_TABLE_BLOG_TAGS, DBValues::DB_TABLE_BLOG_CONTENT, DBValues::DB_TABLE_BLOG_DESCRIPTION, DBValues::DB_TABLE_BLOG_FEATURED])->limit($limit)->offset($offset)->get());
    }

    public function add_post($json)
    {
        $blog_json = json_decode($json);
        $author_uid = DB::table('people')->where('first_name', '=', $blog_json->{'authorName'})->select('uid')->get();
        $author_uid = $author_uid[0]->{'uid'};
        if ($blog_json->{'uid'}) {
            $insert = DB::table(DBValues::DB_TABLE_NAME_BLOG)->where(DBValues::DB_TABLE_BLOG_UID, DBValues::DB_OPERATOR_EQUAL_TO, $blog_json->{'uid'})->update([DBValues::DB_TABLE_BLOG_TITLE => $blog_json->{'title'}, DBValues::DB_TABLE_BLOG_CONTENT => $blog_json->{'content'}, DBValues::DB_TABLE_BLOG_URL_IMAGE => $blog_json->{'imageUrl'}, DBValues::DB_TABLE_BLOG_AUTHOR => $author_uid, DBValues::DB_TABLE_BLOG_CATEGORY => $blog_json->{'categories'}, DBValues::DB_TABLE_BLOG_TAGS => $blog_json->{'tags'}]);
        } else {
            $insert = DB::table(DBValues::DB_TABLE_NAME_BLOG)->Insert([DBValues::DB_TABLE_BLOG_UID => Str::random(10), DBValues::DB_TABLE_BLOG_TITLE => $blog_json->{'title'}, DBValues::DB_TABLE_BLOG_CONTENT => $blog_json->{'content'}, DBValues::DB_TABLE_BLOG_URL_IMAGE => $blog_json->{'imageUrl'}, DBValues::DB_TABLE_BLOG_AUTHOR => $author_uid, DBValues::DB_TABLE_BLOG_CATEGORY => $blog_json->{'categories'}, DBValues::DB_TABLE_BLOG_TAGS => $blog_json->{'tags'}]);
        }
        if ($insert) {
            return response()->json("SUCCESS", 200);
        } else {
            return response()->json("FAILED", 500);
        }
    }

    public function populate_blog($uid)
    {
        $data_response = DB::table(DBValues::DB_TABLE_NAME_BLOG)->where(DBValues::DB_TABLE_BLOG_UID, DBValues::DB_OPERATOR_EQUAL_TO, $uid)->select([DBValues::DB_TABLE_BLOG_TITLE, DBValues::DB_TABLE_BLOG_CONTENT, DBValues::DB_TABLE_BLOG_URL_IMAGE, DBValues::DB_TABLE_BLOG_AUTHOR, DBValues::DB_TABLE_BLOG_CATEGORY, DBValues::DB_TABLE_BLOG_TAGS])->get();
        $populate_blog_data_as_json = response()->json($data_response,200);
        return $populate_blog_data_as_json;
    }
}
