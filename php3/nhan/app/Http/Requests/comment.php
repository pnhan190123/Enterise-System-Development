<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class comment extends FormRequest
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
            'noidung' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'noidung.required' => 'Nhập nội dung kìa bạn ơi',
            'noidung.max' => 'Nội dung quá dài chỉ 255 ký tự',
        ];
    }
}
