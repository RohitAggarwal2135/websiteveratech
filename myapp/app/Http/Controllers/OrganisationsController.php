<?php

namespace App\Http\Controllers;
header("Access-Control-Allow-Origin : *");

use App\Constants\ConstantValues;
use App\Services\Organisation\OrganisationCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class OrganisationsController extends Controller
{
    public function add_organisation(Request $request)
    {
        //        Validation check for required fields.
        $validator = Validator::make($request->all(), [
            ConstantValues::FIELD_NAME_NAME => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_CATEGORY => ConstantValues::FIELD_NAME_REQUIRED
        ]);
        if ($validator->fails()) {
            $validation_failed_response = $validator->messages();
            $name_response_boolean = isset(json_decode(json_encode($validation_failed_response), true)['name']);
            $category_response_boolean = isset(json_decode(json_encode($validation_failed_response), true)['category']);

            if (!$name_response_boolean && $category_response_boolean) {
//                print_r(get_class($validation_failed_response));
                $validation_failed_response->add('name', $request->all()['name']);
            }

            if ($name_response_boolean && !$category_response_boolean) {
//                print_r(get_class($validation_failed_response));
                $validation_failed_response->add('category', $request->all()['category']);
            }
            return response()->json($validation_failed_response, 200)->header(ConstantValues::HEADER_NAME_CORS, ConstantValues::HEADER_VALUE_ALL_OPERATOR);
        }

        $organisation_json = json_encode($request->all());

        $add_organisation = new OrganisationCalls();
        return $add_organisation->organisation_add($organisation_json);
    }

    public function populate_organisation(Request $request)
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

        $populate_organisation = new OrganisationCalls();
        return $populate_organisation->organisation_populate($uid);

    }
}
