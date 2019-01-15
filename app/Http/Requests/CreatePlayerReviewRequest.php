<?php

namespace PaladinsNinja\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlayerReviewRequest extends FormRequest
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
            'match_id' => 'required|exists:matches,match_id',
            'title' => 'required|string|min:5|max:50',
            'body' => 'required|string|min:30|max:350',
            'rating' => 'numeric|min:0|max:5',
        ];
    }
}
