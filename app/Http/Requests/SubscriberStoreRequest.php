<?php

namespace App\Http\Requests;

use App\Enums\SubscriberStateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SubscriberStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:subscribers,email',
            'state' => ['required', new Enum(SubscriberStateEnum::class)],
            'fields' => 'array',
            'fields.*' => 'required|distinct',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'state' => 'Valid values for state field are: `active`, `unsubscribed`, `junk`, `bounced` and `unconfirmed`',
        ];
    }
}
