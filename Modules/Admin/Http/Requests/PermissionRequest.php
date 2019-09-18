<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'title'=>'required',
            'name'=>'required',
            'guard_name'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'菜单名称不能为空',
            'name.required'=>'权限标识不能为空',
            'guard_name.required'=>'Guard不能为空',
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
