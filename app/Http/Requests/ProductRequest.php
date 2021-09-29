<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'title' => 'required|min:3|max:255|unique:products,title',
            'description' => 'required|min:5',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:4'
        ];

        if ($this->route()->named('products.update')) { // Не проверяется уникальность если мы сохраняем то же назание при редактировании
            $rules['title'] .= ',' . $this->route()->parameter('product')->id; //Добавление id редактируемой категории
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'title.min' => 'Поле Название должно содержать не менее :min символов',
            'unique' => 'Название товара должно быть уникальным!'
        ];
    }
}
