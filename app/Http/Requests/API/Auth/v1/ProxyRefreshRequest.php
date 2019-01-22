<?php

namespace PaladinsNinja\Http\Requests\API\Auth\v1;

use Illuminate\Foundation\Http\FormRequest;

class ProxyRefreshRequest extends FormRequest
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
            'refresh_token' => 'required'
        ];
    }
}
