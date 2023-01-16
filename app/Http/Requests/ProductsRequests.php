<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequests extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required|integer',
            'status' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'price.required' => 'Giá không được để trống',
            'category_id.required' => 'Chọn nhóm sản phẩm',
            'category_id.integer' => 'Chọn nhóm sản phẩm',
            'status.required' => 'Trạng thái không được trống',
            'image.required' => 'Cần thêm hình ảnh',
            'image.mines' => 'Ảnh phải có dạng jpg,png,jpeg',
            'image.max' => 'Ảnh dung lượng nhỏ hơn',
            'description.required' => 'Nhập mô tả sản phẩm'
        ];
    }
}
