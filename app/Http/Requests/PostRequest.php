<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            $this->validate([
            'category_id'=>'required',
            'title'=>'required',
            'desq'=>'required',
            'thumb'=>'required',
            'cover_image'=>'required',
            'tags'=>'required',
            ],[
                'category_id.required'=>'Select a category first!',
                'desq.required'=>'Write a description',
                'thumb.required'=>'Select an image first!',
                'cover_image.required'=>'Select a cover photo',
                'tags.required'=>'Select some tags',
            ])
        ];
    }
}
