<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupplierUpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $supplier = $this->route('supplier');
        
        // Check if the supplier exists
        if (!$supplier) {
            return false;
        }
        
        // Admin can update any supplier
        if (Auth::user()->role === 'admin') {
            return true;
        }
        
        // Regular users can only update suppliers they created
        return $supplier->created_by === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $supplier = $this->route('supplier');
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'email' => [
                'nullable', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('suppliers')->ignore($supplier->id)
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'zip' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'string', 'url', 'max:255'],
            'notes' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'in:active,inactive'],
        ];
    }

    /**
     * Perform additional validation checks.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function additionalValidation($validator)
    {
        $supplier = $this->route('supplier');
        
        // Only admin can change status to inactive
        if (!Auth::user()->role === 'admin' && 
            $this->has('status') && 
            $this->input('status') === 'inactive' && 
            $supplier->status === 'active') {
            $validator->errors()->add('status', 'You do not have permission to deactivate suppliers.');
        }
        
        // Validate phone number format if provided
        if ($this->filled('phone')) {
            $phone = preg_replace('/[^0-9]/', '', $this->input('phone'));
            if (strlen($phone) < 10 || strlen($phone) > 15) {
                $validator->errors()->add('phone', 'The phone number must be between 10 and 15 digits.');
            }
        }
        
        // Validate website URL if provided
        if ($this->filled('website') && !filter_var($this->input('website'), FILTER_VALIDATE_URL)) {
            $validator->errors()->add('website', 'The website must be a valid URL.');
        }
    }
}
