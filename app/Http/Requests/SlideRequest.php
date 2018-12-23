<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'Ten'       => 'required',
            'NoiDung'       => 'required',
        ];
    }
    public function messages()
    {
        return [
            'Ten.required'       => 'Bạn chưa nhập tên slide',
            'NoiDung.required'        => 'Bạn chưa nhập nội dung slide',

        ];
    }
}
