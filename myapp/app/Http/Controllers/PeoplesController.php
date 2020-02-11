<?php

namespace App\Http\Controllers;
header("Access-Control-Allow-Origin: *");

use App\Http\Requests\PeopleAddRequest;
use App\Http\Requests\PopulateRequest;
use App\Services\People\PeopleCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PeoplesController extends Controller
{
    public function add_people(PeopleAddRequest $request)
    {
//        Validation check for required fields.
        $validator = $request->validated();

        $people_json = json_encode($request->all());

        $add_people = new PeopleCalls();
        return $add_people->people_add($people_json);
    }

    public function populate_people(PopulateRequest $request)
    {
//        Validation check for required fields.
        $validator = $request->validated();

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
