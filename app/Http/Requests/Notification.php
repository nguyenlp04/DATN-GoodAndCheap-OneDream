<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Notification extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Để cho phép người dùng thực hiện yêu cầu
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'image' => ['image', 'mimes:jpeg,jpg,png,gif,svg'],
            'type' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Please enter the notification title.',
            'content.required' => 'Please enter the notification content.',
            'image.required' => 'Please provide an image for the notification.',
        ];
    }
}
