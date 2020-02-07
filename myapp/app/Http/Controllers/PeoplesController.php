<?php

namespace App\Http\Controllers;

use App\Constants\ConstantValues;
use App\Http\Requests\PostAddRequest;
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
            return response()->json($validator->messages(), 200);
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
            return response()->json($validator->messages(), 200);
        }
        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};

        $populate_people = new PeopleCalls();
        return $populate_people->people_populate($uid);
    }
}
