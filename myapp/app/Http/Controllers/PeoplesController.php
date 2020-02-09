<?php

namespace App\Http\Controllers;
header("Access-Control-Allow-Origin : *");

use App\Constants\ConstantValues;
use App\Services\People\PeopleCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PeoplesController extends Controller
{
    public function add_people(Request $request)
    {
//        Validation check for required fields.
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_FIRST_NAME => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_ORGANISATION => ConstantValues::FIELD_NAME_REQUIRED
        ]);
        if ($validator->fails()) {
            $validation_failed_response = $validator->messages();
            $first_name_response_boolean = isset(json_decode(json_encode($validation_failed_response), true)['first_name']);
            $organisation_response_boolean = isset(json_decode(json_encode($validation_failed_response), true)['organisation']);

            if (!$first_name_response_boolean && $organisation_response_boolean) {
//                print_r(get_class($validation_failed_response));
                $validation_failed_response->add('first_name', $request->all()['first_name']);
            }

            if ($first_name_response_boolean && !$organisation_response_boolean) {
//                print_r(get_class($validation_failed_response));
                $validation_failed_response->add('organisation', $request->all()['organisation']);
            }

            return response()->json($validation_failed_response, 200)->header(ConstantValues::HEADER_NAME_CORS, ConstantValues::HEADER_VALUE_ALL_OPERATOR);
        }

        $people_json = json_encode($request->all());

        $add_people = new PeopleCalls();
        return $add_people->people_add($people_json);
    }

    public function populate_people(Request $request)
    {
//        Validation check for required fields.
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_UID => ConstantValues::FIELD_NAME_REQUIRED,

        ]);
        if ($validator->fails()) {
            $validation_failed_response = $validator->messages();
            return response()->json($validation_failed_response, 200)->header("Access-Control-Allow-Origin", "*");
        }

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};

        $populate_people = new PeopleCalls();
        return $populate_people->people_populate($uid);
    }

    public function get_organization(Request $request)
    {
        $organization_names_for_autocomplete = new PeopleCalls();
        return $organization_names_for_autocomplete->organization_names_from_people_table($request);
    }
}
