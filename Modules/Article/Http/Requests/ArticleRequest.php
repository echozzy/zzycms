<?php

namespace Modules\Article\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'keywords'=>'required',
            'description'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'文章标题不能为空',
            'keywords.required'=>'关键词不能为空',
            'description.required'=>'简介描述不能为空',
        ];
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
