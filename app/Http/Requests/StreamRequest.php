<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StreamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('streams', 'title')->ignore($this->stream?->id, 'id'),
            ],
            'description' => 'nullable|string|max:655',
            'tokens_price' => 'required|integer|min:0',
            'type' => 'nullable|exists:stream_types,id',
            'date_expiration' => [
                'required',
                'date_format:Y-m-d H:i:s',
                'after:now',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The stream title is required.',
            'tokens_price.min' => 'Token price must be zero or higher.',
            'date_expiration.after' => 'Expiration date must be in the future.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => trim(strip_tags($this->title)),
            'description' => strip_tags($this->description),
            'date_expiration' => Carbon::parse($this->date_expiration)->format('Y-m-d H:i:s'),
        ]);
    }
}
