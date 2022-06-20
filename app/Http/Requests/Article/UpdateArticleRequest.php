<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'full_text' => 'required',
            'image' =>'image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required',
            'tag' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'yes, the title is required',
            'full_text.required' => 'A full text is required',
            'category.required' => 'Category is required',
            'tag.required' => 'Tag is required'
        ];
    }

}
