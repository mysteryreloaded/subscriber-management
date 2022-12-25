<?php

namespace App\Http\Requests;

use App\Enums\SubscriberStateEnum;
use App\Models\Subscriber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class SubscriberUpdateRequest extends FormRequest
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
        $email = $this->request->get('email');
        return [
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', 'max:255', Rule::unique(Subscriber::TABLE)->ignore($email, 'email')],
            'state' => ['sometimes', new Enum(SubscriberStateEnum::class)],
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
