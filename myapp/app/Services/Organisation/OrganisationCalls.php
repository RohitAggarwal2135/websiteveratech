<?php

namespace App\Services\Organisation;
header("Access-Control-Allow-Origin: *");

use App\Constants\ConstantValues;
use App\Constants\DBValues;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrganisationCalls
{
    public function organisation_add($json)
    {
        $organisation_json = json_decode($json);
        if ($organisation_json->{'uid'}) {
            $insert = DB::table(DBValues::DB_TABLE_NAME_ORGANIZATION)
                ->where(DBValues::DB_TABLE_ORGANIZATION_UID, DBValues::DB_OPERATOR_EQUAL_TO, $organisation_json->{'uid'})
                ->update([DBValues::DB_TABLE_ORGANIZATION_NAME => $organisation_json->{'name'}, DBValues::DB_TABLE_ORGANIZATION_DESCRIPTION => $organisation_json->{'description'}, DBValues::DB_TABLE_ORGANIZATION_URL_WEBSITE => $organisation_json->{'url_website'}, DBValues::DB_TABLE_ORGANIZATION_CATEGORY => $organisation_json->{'category'}, DBValues::DB_TABLE_ORGANIZATION_URL_LINKEDIN => $organisation_json->{'url_linkedin'}, DBValues::DB_TABLE_ORGANIZATION_URL_GITHUB => $organisation_json->{'url_github'}, DBValues::DB_TABLE_ORGANIZATION_URL_FACEBOOK => $organisation_json->{'url_facebook'}, DBValues::DB_TABLE_ORGANIZATION_URL_TWITTER => $organisation_json->{'url_twitter'}, DBValues::DB_TABLE_ORGANIZATION_URL_LOGO_COLOR => $organisation_json->{'url_logo_color'}, DBValues::DB_TABLE_ORGANIZATION_LOGO_BW => $organisation_json->{'url_logo_bw'}]);

            $insert_default_people = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                ->where(DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID, DBValues::DB_OPERATOR_EQUAL_TO, $organisation_json->{'uid'})
                ->update([DBValues::DB_TABLE_PEOPLE_FIRST_NAME => $organisation_json->{'name'}, DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID => $organisation_json->{'uid'}, DBValues::DB_TABLE_PEOPLE_DESIGNATION => ConstantValues::FIELD_NAME_DEFAULT_USER_DESIGNATION, DBValues::DB_TABLE_PEOPLE_ABOUT => $organisation_json->{'description'}, DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN => $organisation_json->{'url_linkedin'}, DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK => $organisation_json->{'url_facebook'}, DBValues::DB_TABLE_PEOPLE_URL_TWITTER => $organisation_json->{'url_twitter'}, DBValues::DB_TABLE_PEOPLE_URL_GITHUB => $organisation_json->{'url_github'}, DBValues::DB_TABLE_PEOPLE_CATEGORY => $organisation_json->{'category'}, DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC => $organisation_json->{'url_logo_color'}]);
        } else {
            $random_organisation_uid = Str::random(10);
            $insert = DB::table(DBValues::DB_TABLE_NAME_ORGANIZATION)
                ->insert([DBValues::DB_TABLE_ORGANIZATION_UID => $random_organisation_uid, DBValues::DB_TABLE_ORGANIZATION_NAME => $organisation_json->{'name'}, DBValues::DB_TABLE_ORGANIZATION_DESCRIPTION => $organisation_json->{'description'}, DBValues::DB_TABLE_ORGANIZATION_URL_WEBSITE => $organisation_json->{'url_website'}, DBValues::DB_TABLE_ORGANIZATION_CATEGORY => $organisation_json->{'category'}, DBValues::DB_TABLE_ORGANIZATION_URL_LINKEDIN => $organisation_json->{'url_linkedin'}, DBValues::DB_TABLE_ORGANIZATION_URL_GITHUB => $organisation_json->{'url_github'}, DBValues::DB_TABLE_ORGANIZATION_URL_FACEBOOK => $organisation_json->{'url_facebook'}, DBValues::DB_TABLE_ORGANIZATION_URL_TWITTER => $organisation_json->{'url_twitter'}, DBValues::DB_TABLE_ORGANIZATION_URL_LOGO_COLOR => $organisation_json->{'url_logo_color'}, DBValues::DB_TABLE_ORGANIZATION_LOGO_BW => $organisation_json->{'url_logo_bw'}]);

            $insert_default_people = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                ->insert([DBValues::DB_TABLE_PEOPLE_UID => Str::random(10),DBValues::DB_TABLE_PEOPLE_FIRST_NAME => $organisation_json->{'name'}, DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID => $random_organisation_uid, DBValues::DB_TABLE_PEOPLE_DESIGNATION => ConstantValues::FIELD_NAME_DEFAULT_USER_DESIGNATION, DBValues::DB_TABLE_PEOPLE_ABOUT => $organisation_json->{'description'}, DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN => $organisation_json->{'url_linkedin'}, DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK => $organisation_json->{'url_facebook'}, DBValues::DB_TABLE_PEOPLE_URL_TWITTER => $organisation_json->{'url_twitter'}, DBValues::DB_TABLE_PEOPLE_URL_GITHUB => $organisation_json->{'url_github'}, DBValues::DB_TABLE_PEOPLE_CATEGORY => $organisation_json->{'category'}, DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC => $organisation_json->{'url_logo_color'}]);
        }
        if ($insert && $insert_default_people) {
            return response()->json("SUCCESS", 200);
        } else {
            return response()->json("FAILED", 500);
        }
    }

    public function organisation_populate($uid)
    {
        $data_response = DB::table(DBValues::DB_TABLE_NAME_ORGANIZATION)
            ->where(DBValues::DB_TABLE_ORGANIZATION_UID, DBValues::DB_OPERATOR_EQUAL_TO, $uid)
            ->select([DBValues::DB_OPERATOR_SELECT_ALL])
            ->get();

        if (count($data_response) == 0) {
            return response()->json("Wrong uid",500);
        }
        return response()->json($data_response, 200);
    }
}
