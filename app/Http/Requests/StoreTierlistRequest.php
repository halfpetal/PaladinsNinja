<?php

namespace PaladinsNinja\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTierlistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'nullable|min:30',
            'name' => 'required|min:3|max:100',
            'tier_a' => 'nullable|array',
            'tier_b' => 'nullable|array',
            'tier_c' => 'nullable|array',
            'tier_d' => 'nullable|array',
            'tier_s' => 'nullable|array',
            'tier_ss' => 'nullable|array',
        ];
    }
}
