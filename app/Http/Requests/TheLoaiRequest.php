<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TheLoaiRequest extends FormRequest
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
            'txtCateName'       => 'required|unique:TheLoai,Ten|min:2|max:100'
        ];
    }

    public function messages()
    {
        return [
            'txtCateName.required'       => 'Bạn chưa nhập tên thể loại',
            'txtCateName.unique'        => 'Tên thể loại đã tồn tại',
            'txtCateName.min'       =>   'Tên thể loại phải từ 2-100 kí tự',
            'txtCateName.max'       =>   'Tên thể loại phải từ 2-100 kí tự'
        ];
    }

}
