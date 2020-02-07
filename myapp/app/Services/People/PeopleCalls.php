<?php

namespace App\Services\People;

use App\Constants\ConstantValues;
use App\Constants\DBValues;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeopleCalls
{
    public function people_add($json)
    {
        $people_json = json_decode($json);
        if ($people_json->{'uid'}) {
            $insert = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                ->where(DBValues::DB_TABLE_PEOPLE_UID, DBValues::DB_OPERATOR_EQUAL_TO, $people_json->{'uid'})
                ->update([DBValues::DB_TABLE_PEOPLE_FIRST_NAME => $people_json->{'first_name'}, DBValues::DB_TABLE_PEOPLE_LAST_NAME => $people_json->{'last_name'}, DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID => $people_json->{'organisation'}, DBValues::DB_TABLE_PEOPLE_DESIGNATION => $people_json->{'designation'}, DBValues::DB_TABLE_PEOPLE_LOCATION => $people_json->{'location'}, DBValues::DB_TABLE_PEOPLE_ABOUT => $people_json->{'about'}, DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN => $people_json->{'url_linkedin'}, DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK => $people_json->{'url_facebook'}, DBValues::DB_TABLE_PEOPLE_URL_TWITTER => $people_json->{'url_twitter'}, DBValues::DB_TABLE_PEOPLE_URL_GITHUB => $people_json->{'url_github'}, DBValues::DB_TABLE_PEOPLE_EMAIL => $people_json->{'email'}, DBValues::DB_TABLE_PEOPLE_PHONE => $people_json->{'phone'}, DBValues::DB_TABLE_PEOPLE_CATEGORY => $people_json->{'category'}, DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC => $people_json->{'url_profile_pic'}, DBValues::DB_TABLE_PEOPLE_PRIORITY => $people_json->{'priority'}]);
        } else {
            $insert = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                ->insert([DBValues::DB_TABLE_PEOPLE_UID => Str::random(10), DBValues::DB_TABLE_PEOPLE_FIRST_NAME => $people_json->{'first_name'}, DBValues::DB_TABLE_PEOPLE_LAST_NAME => $people_json->{'last_name'}, DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID => $people_json->{'organisation'}, DBValues::DB_TABLE_PEOPLE_DESIGNATION => $people_json->{'designation'}, DBValues::DB_TABLE_PEOPLE_LOCATION => $people_json->{'location'}, DBValues::DB_TABLE_PEOPLE_ABOUT => $people_json->{'about'}, DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN => $people_json->{'url_linkedin'}, DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK => $people_json->{'url_facebook'}, DBValues::DB_TABLE_PEOPLE_URL_TWITTER => $people_json->{'url_twitter'}, DBValues::DB_TABLE_PEOPLE_URL_GITHUB => $people_json->{'url_github'}, DBValues::DB_TABLE_PEOPLE_EMAIL => $people_json->{'email'}, DBValues::DB_TABLE_PEOPLE_PHONE => $people_json->{'phone'}, DBValues::DB_TABLE_PEOPLE_CATEGORY => $people_json->{'category'}, DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC => $people_json->{'url_profile_pic'}, DBValues::DB_TABLE_PEOPLE_PRIORITY => $people_json->{'priority'}]);
        }
        if ($insert) {
            return response()->json("SUCCESS", 200)->header(ConstantValues::HEADER_NAME_CORS, ConstantValues::HEADER_VALUE_ALL_OPERATOR);
        } else {
            return response()->json("FAILED", 500)->header(ConstantValues::HEADER_NAME_CORS, ConstantValues::HEADER_VALUE_ALL_OPERATOR);
        }
    }

    public function people_populate($uid)
    {
        $data_response = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
            ->where(DBValues::DB_TABLE_PEOPLE_UID, DBValues::DB_OPERATOR_EQUAL_TO, $uid)
            ->select([DBValues::DB_TABLE_PEOPLE_FIRST_NAME, DBValues::DB_TABLE_PEOPLE_LAST_NAME, DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID, DBValues::DB_TABLE_PEOPLE_DESIGNATION, DBValues::DB_TABLE_PEOPLE_LOCATION, DBValues::DB_TABLE_PEOPLE_ABOUT, DBValues::DB_TABLE_PEOPLE_EMAIL, DBValues::DB_TABLE_PEOPLE_PHONE, DBValues::DB_TABLE_PEOPLE_CATEGORY, DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC, DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN, DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK, DBValues::DB_TABLE_PEOPLE_URL_TWITTER, DBValues::DB_TABLE_PEOPLE_URL_GITHUB, DBValues::DB_TABLE_PEOPLE_PRIORITY])
            ->get();
        $populate_people_data_as_json = response()->json($data_response, 200)->header(ConstantValues::HEADER_NAME_CORS, ConstantValues::HEADER_VALUE_ALL_OPERATOR);
        return $populate_people_data_as_json;
    }
}
