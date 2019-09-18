<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $menu = $this->route('menu');
        $id = $menu ? $menu->id : null;
        return [
            'title'=>'required|unique:admin_menus,title,'.$id,
            'permission'=>'required',
            'url'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'菜单名称不能为空',
            'title.unique'=>'菜单名称已经存在',
            'permission.required'=>'权限标识不能为空',
            'url.required'=>'URL路径不能为空',
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
