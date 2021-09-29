<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => 'required|min:3|max:255|unique:categories,title',
            'desc' => 'required|min:5',
            'img' => 'nullable|image',
        ];

        // dd(get_class_methods($this->route())); Можно посмотреть все методы класса

        if ($this->route()->named('categories.update')) { // Не проверяется уникальность если мы сохраняем то же назание при редактировании
            $rules['title'] .= ',' . $this->route()->parameter('category')->id; //Добавление id редактируемой категории
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'title.min' => 'Поле Название должно содержать не менее :min символов',
            'unique' => 'Название категории должно быть уникальным!'
        ];
    }
}
