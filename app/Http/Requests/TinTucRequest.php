<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TinTucRequest extends FormRequest
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
            'LoaiTin'           => 'required',
            'TieuDe'           => 'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'           => 'required',
            'NoiDung'           => 'required',
            'Hinh'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'LoaiTin.required'           => 'Bạn chưa chọn loại tin',
            'TieuDe.required'          => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min'               => 'Tiêu đề có ít nhất 3 kí tự',
            'TieuDe.unique'           => 'Tiêu đề đã tồn tại',
            'TomTat.required'         => 'Bạn chưa nhập tóm tắt',
            'NoiDung.required'       => 'Bạn chưa nhập nội dung',
            'Hinh.required'       => 'Bạn chưa nhập Hinh',


        ];
    }
}
