<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title'=>'required|max:255',
            'slug'=>['required','max:255',Rule::unique('posts','slug')->ignore($this->route('post'))],
            'description'=>'required',
            'category_id'=>'required|exists:categories,id'
        ];
    }
}
