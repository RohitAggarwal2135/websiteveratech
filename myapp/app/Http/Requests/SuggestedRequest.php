<?php

namespace App\Http\Requests;

use App\Constants\ConstantValues;
use Illuminate\Foundation\Http\FormRequest;

class SuggestedRequest extends FormRequest
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
            ConstantValues::FIELD_NAME_ID => ConstantValues::FIELD_NAME_REQUIRED,
        ];
    }

    public function messages()
    {
        return [
            ConstantValues::FIELD_NAME_ID . ConstantValues::FIELD_NAME_OPERATOR_DOT . ConstantValues::FIELD_NAME_REQUIRED => ConstantValues::FIELD_NAME_ID_IS_MISSING,
        ];
    }
}
