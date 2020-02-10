<?php

namespace App\Http\Requests;
use App\Constants\ConstantValues;
use Illuminate\Foundation\Http\FormRequest;

class PostAddRequest extends FormRequest
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
            ConstantValues::FIELD_NAME_TITLE => ConstantValues::FIELD_NAME_REQUIRED,
            ConstantValues::FIELD_NAME_AUTHOR => ConstantValues::FIELD_NAME_REQUIRED,
        ];
    }
}
