<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:254',
            'message' => 'required|string|min:10|max:2000',
            'website' => 'size:0', // Honeypot — must be empty. Bots fill this, humans don't see it.
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Please include your name.',
            'email.required'   => 'Please include a valid email address.',
            'email.email'      => 'That doesn\'t look like a valid email address.',
            'message.required' => 'Message can\'t be empty.',
            'message.min'      => 'Message must be at least 10 characters.',
            'message.max'      => 'Message can\'t exceed 2000 characters.',
            'website.size'     => 'Submission rejected. Insufficient', // Vague on purpose
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }

}
