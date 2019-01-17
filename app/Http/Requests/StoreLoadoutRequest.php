<?php

namespace PaladinsNinja\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoadoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check() && \Auth::user()->hasPermissionTo('tools.loadout-builder.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'champion' => 'required|numeric',
            'name' => 'required|string|min:5|max:45',
            'description' => 'nullable|string|min:20',
            'cards' => 'required',
        ];
    }
}
