<?php

namespace App\Http\Controllers;
header("Access-Control-Allow-Origin: *");

use App\Http\Requests\OrganisationAddRequest;
use App\Http\Requests\PopulateRequest;
use App\Services\Organisation\OrganisationCalls;
use Illuminate\Routing\Controller;

class OrganisationsController extends Controller
{
    public function add_organisation(OrganisationAddRequest $request)
    {
//        Validation check for required fields.
        $validator = $request->validated();

        $organisation_json = json_encode($request->all());

        $add_organisation = new OrganisationCalls();
        return $add_organisation->organisation_add($organisation_json);
    }

    public function populate_organisation(PopulateRequest $request)
    {
//        Validation check for required fields.
        $validator = $request->validated();

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};

        $populate_organisation = new OrganisationCalls();
        return $populate_organisation->organisation_populate($uid);

    }
}
