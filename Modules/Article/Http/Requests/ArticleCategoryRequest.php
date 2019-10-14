<?php

namespace Modules\Article\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $article_category = $this->route('article_category');
        $id = $article_category ? $article_category->id : null;
        return [
            'cat_name'=>'required|unique:article_categories,cat_name,'.$id,
        ];
    }

    public function messages()
    {
        return [
            'cat_name.required'=>'分类名称不能为空',
            'cat_name.unique'=>'分类名称已经存在',
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
