<?php

namespace App\Http\Requests;

use App\Enums\SubscriberStateEnum;
use App\Models\Subscriber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class SubscriberRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $email = $this->request->get('email');
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique(Subscriber::TABLE)->ignore($email, 'email')],
            'state' => ['required', new Enum(SubscriberStateEnum::class)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'state' => 'Valid values are `active`, `unsubscribed`, `junk`, `bounced` and `unconfirmed`',
        ];
    }
}
