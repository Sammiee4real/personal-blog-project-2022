<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:articles|max:255',
            'full_text' => 'required',
            'image' => 'required',
            'category' => 'required',
            'tag' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'yes, the title is required',
            'title.unique' => 'title has to be unique',
            'full_text.required' => 'A full text is required',
            'category.required' => 'Category is required',
            'tag.required' => 'Tag is required'
        ];
    }


}
