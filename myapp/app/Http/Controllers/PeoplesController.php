<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Http\Controllers;

use App\Constants\ConstantValues;

header(ConstantValues::HEADER_NAME_CORS . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::HEADER_VALUE_ALL_OPERATOR);

use App\Http\Requests\PeopleAddRequest;
use App\Http\Requests\PopulateRequest;
use App\Services\People\PeopleCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PeoplesController extends Controller
{
    /*
     * The 'add_people' function is called to add new People or update the details of a existing one.
     * The function validates and check for 'First Name' and 'Organisation' field.
     * The Request is of 'PeopleAddRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a PeopleCalls Object and call the "people_add" function.
     */
    public function add_people(PeopleAddRequest $request)
    {
//        Validation check for required fields.
        $validator = $request->validated();

        $people_json = json_encode($request->all());

        $add_people = new PeopleCalls();
        return $add_people->people_add($people_json);
    }

    /*
     * The 'populate_people' function is called to populate the data of a existing People.
     * The function validates and check for 'uid' field.
     * The Request is of 'PopulateRequest' type and it returns the errors in json format(if any).
     * The json is handled at the JavaScript end for raising appropriate errors.
     * It creates a PeopleCalls Object and call the "people_populate" function.
     */
    public function populate_people(PopulateRequest $request)
    {
//        Validation check for required fields.
        $validator = $request->validated();

        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};

        $populate_people = new PeopleCalls();
        return $populate_people->people_populate($uid);
    }

    /*
     * The 'get_organization' function is called to Get Organization to complete
     * in the Organization Name AutoEasyComplete DropDown.
     * It creates a PeopleCalls Object and call the "organization_names_from_people_table" function.
     */
    public function get_organization(Request $request)
    {
        $organization_names_for_autocomplete = new PeopleCalls();
        return $organization_names_for_autocomplete->organization_names_from_organization_table($request);
    }
}
