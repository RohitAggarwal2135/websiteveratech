<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Http\Requests;

use App\Constants\ConstantValues;
use Illuminate\Foundation\Http\FormRequest;

class GetForAuthorRequest extends FormRequest
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
     * author => required
     * limit => required|integer|between 1,10
     * offset => required|integer
     */
    public function rules()
    {
        return [
            ConstantValues::FIELD_NAME_AUTHOR => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_LIMIT => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_BETWEEN . ConstantValues::FIELD_NAME_OPERATOR_COLON . ConstantValues::FIELD_NAME_LIMIT_RANGE,
            ConstantValues::FIELD_NAME_OFFSET => ConstantValues::FIELD_NAME_REQUIRED . ConstantValues::FIELD_NAME_OPERATOR_VERTICAL_BAR . ConstantValues::FIELD_NAME_INTEGER,
        ];
    }
}
