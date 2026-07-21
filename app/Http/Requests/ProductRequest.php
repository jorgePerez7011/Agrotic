<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('POST')) {
            return [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'price' => 'nullable',
                'quantity' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png|max:6000',
                'status' => 'nullable',
                'registered_by' => 'nullable',
            ];
        } elseif (request()->isMethod('put')) {
            return [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'price' => 'nullable',
                'quantity' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png|max:6000',
                'status' => 'nullable',
                'registered_by' => 'nullable',
            ];
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es requerido',
            'name.string' => 'El nombre debe ser texto',
            'name.max' => 'El nombre no puede exceder los 255 caracteres',
            'description.string' => 'La descripción debe ser texto',
            'description.max' => 'La descripción no puede exceder los 1000 caracteres',
            'quantity.required' => 'La cantidad es requerida',
            'image.mimes' => 'La imagen debe ser de tipo: jpg, jpeg o png',
            'image.max' => 'La imagen no puede exceder 6MB'
        ];
    }
}