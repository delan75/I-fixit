<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    abstract public function rules(): array;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize(): bool;

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Log validation failures for security monitoring
        Log::warning('Validation failed', [
            'user_id' => auth()->id() ?? 'unauthenticated',
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'errors' => $validator->errors()->toArray(),
            'input' => $this->except(['password', 'password_confirmation']),
        ]);

        parent::failedValidation($validator);
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Add additional security checks here
            $this->additionalValidation($validator);
        });
    }

    /**
     * Perform additional validation checks.
     * Override this method in child classes to add custom validation.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function additionalValidation($validator)
    {
        // To be implemented by child classes
    }

    /**
     * Sanitize input data before validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $input = $this->all();
        
        // Sanitize all string inputs
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = $this->sanitizeString($value);
            }
        }
        
        $this->replace($input);
    }

    /**
     * Basic string sanitization.
     *
     * @param string $value
     * @return string
     */
    protected function sanitizeString($value)
    {
        // Remove null bytes and other potentially harmful characters
        $value = str_replace(chr(0), '', $value);
        
        // Trim whitespace
        $value = trim($value);
        
        return $value;
    }
}
