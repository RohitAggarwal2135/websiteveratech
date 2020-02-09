<?php

namespace App\Services\Organisation;
header("Access-Control-Allow-Origin : *");

use App\Constants\DBValues;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;

class OrganisationCalls
{
    public function organisation_add($json)
    {
        $organisation_json = json_decode($json);
        if ($organisation_json->{'uid'}) {
            $insert = DB::table('organization')
                ->where('uid', DBValues::DB_OPERATOR_EQUAL_TO, $organisation_json->{'uid'})
                ->update(['name' => $organisation_json->{'name'}, 'description' => $organisation_json{'description'}, 'url_website' => $organisation_json->{'url_website'}, 'category' => $organisation_json->{'category'}, 'url_linkedin' => $organisation_json->{'url_linkedin'}, 'url_github' => $organisation_json->{'url_github'}, 'url_facebook' => $organisation_json->{'url_facebook'}, 'url_twitter' => $organisation_json->{'url_twitter'}, 'url_logo_color' => $organisation_json->{'url_logo_color'}, 'url_logo_bw' => $organisation_json->{'url_logo_bw'}]);
        } else {
            $insert = DB::table('organization')
                ->insert(['uid' => Str::random(10), 'name' => $organisation_json->{'name'}, 'description' => $organisation_json->{'description'}, 'url_website' => $organisation_json->{'url_website'}, 'category' => $organisation_json->{'category'}, 'url_linkedin' => $organisation_json->{'url_linkedin'}, 'url_github' => $organisation_json->{'url_github'}, 'url_facebook' => $organisation_json->{'url_facebook'}, 'url_twitter' => $organisation_json->{'url_twitter'}, 'url_logo_color' => $organisation_json->{'url_logo_color'}, 'url_logo_bw' => $organisation_json->{'url_logo_bw'}]);
        }
        if ($insert) {
            return response()->json("SUCCESS", 200)->header("Access-Control-Allow-Origin", "*");
        } else {
            return response()->json("FAILED", 500)->header("Access-Control-Allow-Origin", "*");
        }
    }

    public function organisation_populate($uid)
    {
        $data_response = DB::table('organization')
            ->where('uid', DBValues::DB_OPERATOR_EQUAL_TO, $uid)
            ->select([DBValues::DB_OPERATOR_SELECT_ALL])
            ->get();

        if (count($data_response) == 0) {
            return response()->json("Wrong uid")->header("Access-Control-Allow-Origin", "*");
        }
        return response()->json($data_response, 200)->header("Access-Control-Allow-Origin", "*");
    }
}
