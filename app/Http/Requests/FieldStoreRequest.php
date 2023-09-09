<?php

namespace App\Http\Requests;

use App\Enums\FieldTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class FieldStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => ['required', new Enum(FieldTypeEnum::class)],
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
            'type' => 'Valid values for type field are: `date`, `number`, `string` and `boolean`',
        ];
    }
}
