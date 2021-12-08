<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        // dd($this->user_id);
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user_id . ',id'],
            'phone' => ['required',  'unique:users,phone,' . $this->user_id . 'id'],
            'address' => ['required'],
            'type' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập đầy đủ họ tên',
            'email.required' => 'Nhập đầy đủ email',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'phone.required' => 'Nhập đầy đủ số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống',
            'address.required' => 'Nhập đầy đủ địa chỉ',
            'type.required' => 'Vui lòng chọn chức vụ',
        ];
    }
}
