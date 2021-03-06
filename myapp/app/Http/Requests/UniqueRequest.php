<?php

/*
 * Created by PhpStorm
 * User: Raman Mehta
 */

namespace App\Http\Requests;

use App\Constants\ConstantValues;
use Illuminate\Foundation\Http\FormRequest;

class UniqueRequest extends FormRequest
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
     * id => required
     */
    public function rules()
    {
        return [
            ConstantValues::FIELD_NAME_ID => ConstantValues::FIELD_NAME_REQUIRED
        ];
    }
}
