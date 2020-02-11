<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Http\Requests;
header("Access-Control-Allow-Origin: *");

use App\Constants\ConstantValues;
use Illuminate\Foundation\Http\FormRequest;

class PeopleAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /*
     * name => required
     * organisation => required
     */
    public function rules()
    {
        return [
            ConstantValues::FIELD_NAME_FIRST_NAME => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_ORGANISATION => ConstantValues::FIELD_NAME_REQUIRED,
        ];
    }
}
