<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoaiTinRequest extends FormRequest
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
            'txtCateName'       => 'required|unique:LoaiTin,Ten|min:2|max:100',
            'TheLoai'         =>'required',

        ];
    }
    public function messages()
    {
        return [
            'txtCateName.required'       => 'Bạn chưa nhập tên loại tin',
            'txtCateName.unique'        => 'Tên loại tin đã tồn tại',
            'txtCateName.min'           =>   'Tên loại tin  phải từ 2-100 kí tự',
            'txtCateName.max'           =>   'Tên loại tin  phải từ 2-100 kí tự',
            'TheLoai.required'         =>   'Bạn chưa chọn thể loại',

        ];
    }
}
