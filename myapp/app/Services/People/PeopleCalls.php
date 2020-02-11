<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Services\People;

use App\Constants\ConstantValues;

header(ConstantValues::HEADER_NAME_CORS . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::HEADER_VALUE_ALL_OPERATOR);

use App\Constants\DBValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeopleCalls
{
    /*
     * The 'people_add' function gets a json object with the form data of the add_people HTML Page.
     * It gets the organisation uid from organization table first.
     * corresponding to that the people is added with the organisation uid in the people table.
     * if the uid is provided in the form data, then the form data is
     * correspondingly gets updated in the table instead of new entry.
     * Returns "Unknown Organisation" if the organisation provided doesn't exists already.
     */
    public function people_add($json)
    {
        $people_json = json_decode($json);
        $organization_uid = DB::table(DBValues::DB_TABLE_NAME_ORGANIZATION)
            ->where(DBValues::DB_TABLE_ORGANIZATION_NAME, DBValues::DB_OPERATOR_EQUAL_TO, $people_json->{'organisation'})
            ->select(DBValues::DB_TABLE_ORGANIZATION_UID)
            ->get();

        if (isset($organization_uid[0]->{'uid'})) {
            $organization_uid = $organization_uid[0]->{'uid'};
            if ($people_json->{'uid'}) {
                $insert = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                    ->where(DBValues::DB_TABLE_PEOPLE_UID, DBValues::DB_OPERATOR_EQUAL_TO, $people_json->{'uid'})
                    ->update([DBValues::DB_TABLE_PEOPLE_FIRST_NAME => $people_json->{'first_name'}, DBValues::DB_TABLE_PEOPLE_LAST_NAME => $people_json->{'last_name'}, DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID => $organization_uid, DBValues::DB_TABLE_PEOPLE_DESIGNATION => $people_json->{'designation'}, DBValues::DB_TABLE_PEOPLE_LOCATION => $people_json->{'location'}, DBValues::DB_TABLE_PEOPLE_ABOUT => $people_json->{'about'}, DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN => $people_json->{'url_linkedin'}, DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK => $people_json->{'url_facebook'}, DBValues::DB_TABLE_PEOPLE_URL_TWITTER => $people_json->{'url_twitter'}, DBValues::DB_TABLE_PEOPLE_URL_GITHUB => $people_json->{'url_github'}, DBValues::DB_TABLE_PEOPLE_EMAIL => $people_json->{'email'}, DBValues::DB_TABLE_PEOPLE_PHONE => $people_json->{'phone'}, DBValues::DB_TABLE_PEOPLE_CATEGORY => $people_json->{'category'}, DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC => $people_json->{'url_profile_pic'}, DBValues::DB_TABLE_PEOPLE_PRIORITY => $people_json->{'priority'}]);
            } else {
                $insert = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
                    ->insert([DBValues::DB_TABLE_PEOPLE_UID => Str::random(10), DBValues::DB_TABLE_PEOPLE_FIRST_NAME => $people_json->{'first_name'}, DBValues::DB_TABLE_PEOPLE_LAST_NAME => $people_json->{'last_name'}, DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID => $organization_uid, DBValues::DB_TABLE_PEOPLE_DESIGNATION => $people_json->{'designation'}, DBValues::DB_TABLE_PEOPLE_LOCATION => $people_json->{'location'}, DBValues::DB_TABLE_PEOPLE_ABOUT => $people_json->{'about'}, DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN => $people_json->{'url_linkedin'}, DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK => $people_json->{'url_facebook'}, DBValues::DB_TABLE_PEOPLE_URL_TWITTER => $people_json->{'url_twitter'}, DBValues::DB_TABLE_PEOPLE_URL_GITHUB => $people_json->{'url_github'}, DBValues::DB_TABLE_PEOPLE_EMAIL => $people_json->{'email'}, DBValues::DB_TABLE_PEOPLE_PHONE => $people_json->{'phone'}, DBValues::DB_TABLE_PEOPLE_CATEGORY => $people_json->{'category'}, DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC => $people_json->{'url_profile_pic'}, DBValues::DB_TABLE_PEOPLE_PRIORITY => $people_json->{'priority'}]);
            }
            if ($insert) {
                return response()->json("SUCCESS", 200);
            } else {
                return response()->json("FAILED", 500);
            }
        } else {
            return response()->json("Unknown Organisation", 500);
        }
    }

    /*
     * The 'people_populate' function gets uid.
     * It returns the people table data corresponding to the provided uid.
     * Returns "Wrong uid" if the uid provided doesn't exists in the people table.
     */
    public function people_populate($uid)
    {
        $data_response = DB::table(DBValues::DB_TABLE_NAME_PEOPLE)
            ->join(DBValues::DB_TABLE_NAME_ORGANIZATION, DBValues::DB_TABLE_NAME_ORGANIZATION . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_ORGANIZATION_UID, DBValues::DB_OPERATOR_EQUAL_TO, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_ORGANISATION_ID)
            ->where(DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_UID, DBValues::DB_OPERATOR_EQUAL_TO, $uid)
            ->select([DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_FIRST_NAME, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_LAST_NAME, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_DESIGNATION, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_LOCATION, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_ABOUT, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_EMAIL, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_PHONE, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_CATEGORY, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_URL_PROFILE_PIC, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_URL_LINKEDIN, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_URL_FACEBOOK, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_URL_TWITTER, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_URL_GITHUB, DBValues::DB_TABLE_NAME_PEOPLE . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_PEOPLE_PRIORITY, DBValues::DB_TABLE_NAME_ORGANIZATION . DBValues::DB_OPERATOR_DOT . DBValues::DB_TABLE_ORGANIZATION_NAME])
            ->get();

        if (count($data_response) == 0) {
            return response()->json("Wrong uid", 500);
        }
        return response()->json($data_response, 200);
    }

    /*
     * The 'organization_names_from_organization_table' function returns json object
     * having "name" as key value and value as the organization names.
     * It's used in the EasyAutoComplete DropDown to show the organizations present
     * in the organization's table corresponding to the provided query in the input field.
     */
    public function organization_names_from_organization_table(Request $request)
    {
        $json_organization_names = [];
        $query = $request->get('phrase');
        if ($query != '') {
            $data = DB::table(DBValues::DB_TABLE_NAME_ORGANIZATION)
                ->where(DBValues::DB_TABLE_ORGANIZATION_NAME, DBValues::DB_OPERATOR_LIKE, DBValues::DB_OPERATOR_LIKE_PERCENTAGE . $query . DBValues::DB_OPERATOR_LIKE_PERCENTAGE)
                ->select(DBValues::DB_TABLE_ORGANIZATION_NAME)
                ->get();
        } else {
            $data = DB::table(DBValues::DB_TABLE_NAME_ORGANIZATION)
                ->select(DBValues::DB_TABLE_ORGANIZATION_NAME)
                ->get();
        }

        for ($index = 0; $index < count($data); $index++) {
            $json_organization_names[$index] = $data[$index];
        }
        return response()->json($json_organization_names);
    }
}
