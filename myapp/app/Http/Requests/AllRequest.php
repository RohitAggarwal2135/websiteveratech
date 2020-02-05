<?php

namespace App\Http\Requests;

use App\Constants\ConstantValues;
use Illuminate\Foundation\Http\FormRequest;

class AllRequest extends FormRequest
{
    const LIMIT_RANGE = '1,10'; // RANGE FOR LIMIT VALUE
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
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . AllRequest::LIMIT_RANGE,
            ConstantValues::FIELD_NAME_OFFSET => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER,
        ];
    }

    public function messages()
    {
        return [
            ConstantValues::FIELD_NAME_LIMIT . ConstantValues::FIELD_NAME_OPERATOR_DOT . ConstantValues::FIELD_NAME_REQUIRED => ConstantValues::FIELD_NAME_LIMIT_IS_MISSING,
            ConstantValues::FIELD_NAME_LIMIT . ConstantValues::FIELD_NAME_OPERATOR_DOT . ConstantValues::FIELD_NAME_INTEGER => ConstantValues::FIELD_NAME_LIMIT_NOT_INTEGER,
            ConstantValues::FIELD_NAME_LIMIT . ConstantValues::FIELD_NAME_OPERATOR_DOT . ConstantValues::FIELD_NAME_BETWEEN => ConstantValues::FIELD_NAME_LIMIT_NOT_BETWEEN,
            ConstantValues::FIELD_NAME_OFFSET . ConstantValues::FIELD_NAME_OPERATOR_DOT . ConstantValues::FIELD_NAME_REQUIRED => ConstantValues::FIELD_NAME_OFFSET_IS_MISSING,
            ConstantValues::FIELD_NAME_OFFSET . ConstantValues::FIELD_NAME_OPERATOR_DOT . ConstantValues::FIELD_NAME_INTEGER => ConstantValues::FIELD_NAME_OFFSET_NOT_INTEGER,
        ];
    }
}
