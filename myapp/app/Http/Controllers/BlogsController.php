<?php

namespace App\Http\Controllers;

header("Access-Control-Allow-Origin: *");

use App\Constants\ConstantValues;
use App\Constants\DBValues;
use App\Http\Requests\AllRequest;
use App\Http\Requests\SuggestedRequest;
use App\Services\Blog\BlogCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{

    public function index(Request $request)
    {
        return view('posts.create');
    }

    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function top_story(Request $request)
    {
        $top_story = new BlogCalls();
        return $top_story->top_story($request);
    }

    public function categories(Request $request)
    {
        $category = new BlogCalls();
        return $category->categories($request);
    }

    public function suggested_blog(SuggestedRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $id = $data['id'];

        $suggested_blog = new BlogCalls();
        return $suggested_blog->suggested_blog($id);
    }

    public function all_blogs_paginated(AllRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new BlogCalls();
        return $all_blogs_paginated->all_blogs_paginated($limit, $offset);
    }

    public function postsadd(Request $request)
    {
        $blog_json = json_encode($request->all());
        $add_post = new BlogCalls();
        return $add_post->add_post($blog_json);
    }

    public function populate_blog(Request $request)
    {
        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};
        $blog_populate = new BlogCalls();
        return $blog_populate->populate_blog($uid);
    }

    public function live_blog_search(Request $request)
    {
        $output = '';
        $query = $request->get('query');
        if ($query != '') {
            $data = DB::table(DBValues::DB_TABLE_NAME_BLOG)
                    ->join(DBValues::DB_TABLE_NAME_PEOPLE,DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_AUTHOR, DBValues::DB_OPERATOR_EQUAL_TO, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_UID)
                    ->where(DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_TITLE, DBValues::DB_OPERATOR_LIKE, DBValues::DB_OPERATOR_LIKE_PERCENTAGE . $query . DBValues::DB_OPERATOR_LIKE_PERCENTAGE)
                    ->orWhere(DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_FIRST_NAME, DBValues::DB_OPERATOR_LIKE, DBValues::DB_OPERATOR_LIKE_PERCENTAGE . $query . DBValues::DB_OPERATOR_LIKE_PERCENTAGE)
                    ->orWhere(DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_CATEGORY, DBValues::DB_OPERATOR_LIKE, DBValues::DB_OPERATOR_LIKE_PERCENTAGE . $query . DBValues::DB_OPERATOR_LIKE_PERCENTAGE)
                    ->orWhere(DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_TAGS, DBValues::DB_OPERATOR_LIKE, DBValues::DB_OPERATOR_LIKE_PERCENTAGE . $query . DBValues::DB_OPERATOR_LIKE_PERCENTAGE)
                    ->orderBy(DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_LAST_UPDATED_TIME, DBValues::DB_OPERATOR_DECREASING_ORDER)
                    ->select(DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_UID, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_TITLE, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_CONTENT, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_CATEGORY, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_TAGS, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_FIRST_NAME)
                    ->get();
        } else {
            $data = DB::table(DBValues::DB_TABLE_NAME_BLOG)
                ->join(DBValues::DB_TABLE_NAME_PEOPLE,DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_AUTHOR, DBValues::DB_OPERATOR_EQUAL_TO, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_UID)
                ->orderBy(DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_LAST_UPDATED_TIME, DBValues::DB_OPERATOR_DECREASING_ORDER)
                ->select(DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_UID, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_TITLE, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_CONTENT, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_CATEGORY, DBValues::DB_TABLE_NAME_BLOG . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_BLOG_TAGS, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_FIRST_NAME)
                ->get();
        }
        $total_row = $data->count();
        if ($total_row > 0) {
            foreach ($data as $row) {
                $output .= "
                    <tr>
                        <td>$row->uid</td>
                        <td>$row->title</td>
                        <td>$row->content</td>
                        <td>$row->first_name</td>
                        <td>$row->category</td>
                        <td>$row->tags</td>
                    </tr>
                            ";
            }
        } else {
            $output = "
                <tr>
                    <td align='center' colspan='5'>NO BLOG FOUND</td>
                </tr>
                        ";
        }
        $data = array(
            'table_data' => $output,
            'total_data' => $total_row
        );

        echo json_encode($data);
    }


    public function get_authors(Request $request)
    {
        $json_author_names = [];
        $query = $request->get('phrase');
        if ($query != '') {
            $data = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                ->where(DBValues::DB_TABLE_PEOPLE_FIRST_NAME, DBValues::DB_OPERATOR_LIKE, DBValues::DB_OPERATOR_LIKE_PERCENTAGE . $query . DBValues::DB_OPERATOR_LIKE_PERCENTAGE)
                ->select(DBValues::DB_TABLE_PEOPLE_FIRST_NAME)
                ->get();
        } else {
            $data = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                ->select(DBValues::DB_TABLE_PEOPLE_FIRST_NAME)
                ->get();
        }

        for($index = 0; $index < count($data); $index++){
            $json_author_names[$index] = $data[$index];
        }

        return json_encode($json_author_names);
    }
}
























