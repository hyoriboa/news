<?php

namespace App\Http\Requests;

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
            //
            'name'           => 'required|min:3',
            'email'           => 'required|unique:users,email',
            'password'           => 'required|min:3|max:32',
            'passwordAgain'           => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required'           => 'Bạn chưa nhập tên người dùng',
            'name.min'          => 'Tên người dùng ít nhất 3 kí tự',
            'email.required'               => 'Bạn chưa nhập email người dùng',
            'email.email'               => 'Bạn chưa nhập đúng định dạng email',
            'email.unique'           => 'Email đã tồn tại',
            'password.required'         => 'Bạn chưa nhập mật khẩu',
            'password.min'       => 'Mật khẩu từ 3-32 kí tự',
            'password.max'       => 'Mật khẩu từ 3-32 kí tự',
            'passwordAgain.required'       => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'       => 'Mật khẩu nhập lại không khớp',


        ];
    }
}
