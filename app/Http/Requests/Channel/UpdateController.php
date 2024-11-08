<?php

namespace App\Http\Requests\Channel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateController extends FormRequest
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
            'name_channel' => 'required|string|max:255',
            'image_channel' => 'nullable|image|max:1024',
            'address' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:12|regex:/^[0-9]+$/',
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
            'name_channel.required' => 'Please enter the channel name.',
            'image_channel.image' => 'The uploaded file must be an image.',
            'address.required' => 'Please enter the address.',
            'phone_number.regex' => 'The phone number may only contain digits.',
        ];
    }
}
