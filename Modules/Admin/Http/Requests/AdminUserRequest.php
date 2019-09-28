<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $admin_user = $this->route('admin_user');
        $id = $admin_user ? $admin_user->id : null;
        $rules = [
            'user_name'=>'required|unique:admin_users,user_name,'.$id,
            'nick_name'=>'required',
            'role_id'=>'required'
        ];
        if(!$id){
            $rules['password'] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'user_name.required'=>'管理员账号不能为空',
            'user_name.unique'=>'管理员账号已经存在',
            'password.required'=>'登录密码不能为空',
            'nick_name.required'=>'昵称不能为空',
            'role_id.required'=>'管理员角色不能为空'
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
