<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'top_title' => 'required|string',
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'offer' => 'nullable|string',
            'link' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|integer'
        ];
    }
}
