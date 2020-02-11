<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Http\Controllers;

use App\Constants\ConstantValues;

header(ConstantValues::HEADER_NAME_CORS . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::HEADER_VALUE_ALL_OPERATOR);

use App\Http\Requests\OrganisationAddRequest;
use App\Http\Requests\PopulateRequest;
use App\Services\Organisation\OrganisationCalls;
use Illuminate\Routing\Controller;

class OrganisationsController extends Controller
{
    /*
     * The 'add_organisation' function is called to add new Organisation or update a existing one.
     * The function validates and check for 'Name' and 'Category' field.
     * The Request is of 'OrganisationAddRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a OrganisationCalls Object and call the "organisation_add" function.
     */
    public function add_organisation(OrganisationAddRequest $request)
    {
//        Validation check for required fields.
        $validator = $request->validated();

        $organisation_json = json_encode($request->all());

        $add_organisation = new OrganisationCalls();
        return $add_organisation->organisation_add($organisation_json);
    }

    /*
     * The 'populate_organisation' function is called to populate the data of a existing Organisation.
     * The function validates and check for 'uid' field.
     * The Request is of 'PopulateRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a OrganisationCalls Object and call the "organisation_populate" function.
     */
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
