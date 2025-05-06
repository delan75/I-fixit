<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class CarUpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $car = $this->route('car');
        
        // Check if the car exists
        if (!$car) {
            return false;
        }
        
        // Admin can update any car
        if (Auth::user()->role === 'admin') {
            return true;
        }
        
        // Regular users can only update cars they created
        return $car->created_by === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'make' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'vin' => ['nullable', 'string', 'max:17'],
            'color' => ['nullable', 'string', 'max:50'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'purchase_date' => ['required', 'date'],
            'current_phase' => ['required', 'string', 'in:bidding,fixing,dealership,sold'],
            'notes' => ['nullable', 'string'],
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
        $car = $this->route('car');
        
        // Prevent changing critical fields if the car is in sold phase
        if ($car->current_phase === 'sold' && $this->input('current_phase') !== 'sold') {
            $validator->errors()->add('current_phase', 'Cannot change the phase of a sold car.');
        }
        
        // Validate VIN format if provided
        if ($this->filled('vin') && strlen($this->input('vin')) === 17) {
            // Basic VIN validation - should be alphanumeric and not contain I, O, or Q
            if (preg_match('/[IOQ]/', $this->input('vin')) || !preg_match('/^[A-HJ-NPR-Z0-9]{17}$/', $this->input('vin'))) {
                $validator->errors()->add('vin', 'The VIN format is invalid.');
            }
        }
    }
}
