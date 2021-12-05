<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required',  'unique:users'],
            'address' => ['required'],
            'type' => ['required'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập đầy đủ họ tên',
            'email.required' => 'Nhập đầy đủ email',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải 8 ký tự trở lên',
            'phone.required' => 'Nhập đầy đủ số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống',
            'address.required' => 'Nhập đầy đủ địa chỉ',
            'type.required' => 'Vui lòng chọn chức vụ',
        ];
    }
}
