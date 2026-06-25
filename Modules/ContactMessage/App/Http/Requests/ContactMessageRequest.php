<?php

namespace Modules\ContactMessage\App\Http\Requests;

use App\Rules\Captcha;
use App\Rules\DisposableEmail;
use App\Rules\ValidPhone;
use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $rules = [
            'name'=>'required',
            'email' => ['required', 'email', new DisposableEmail()],
            'phone' => ['nullable', 'string', 'max:20', new ValidPhone()],
            'message'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('Name is required'),
            'email.required' => trans('Email is required'),
            'email.email'    => trans('Please enter a valid email address'),
            'phone.max'      => trans('Phone number is too long'),
            'message.required' => trans('Message is required')
        ];
    }
}
