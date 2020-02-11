<?php

namespace App\Http\Requests;

use App\Constants\ConstantValues;
use Illuminate\Foundation\Http\FormRequest;

class OrganisationAddRequest extends FormRequest
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
    public function rules()
    {
        return [
            ConstantValues::FIELD_NAME_NAME => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_CATEGORY => ConstantValues::FIELD_NAME_REQUIRED
        ];
    }
}
