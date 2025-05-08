<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserUpdateRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->route('user');

        // Check if the user exists
        if (!$user) {
            return false;
        }

        // Superuser can update any user
        if (Auth::user()->isSuperuser()) {
            return true;
        }

        // Admin can update any user except superusers
        if (Auth::user()->isAdmin()) {
            return !$user->isSuperuser();
        }

        // Regular users can only update their own profile
        return Auth::id() === $user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
        ];

        // Admin and superuser can change roles
        if (Auth::user()->hasAdminAccess()) {
            $rules['role'] = ['sometimes', 'required', 'string', 'in:admin,user'];
        }

        // Only superuser can change superuser status
        if (Auth::user()->isSuperuser()) {
            $rules['is_superuser'] = ['sometimes', 'boolean'];
        }

        // Password is optional on update
        if ($this->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        return $rules;
    }

    /**
     * Perform additional validation checks.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function additionalValidation($validator)
    {
        $user = $this->route('user');
        $currentUser = Auth::user();

        // Prevent non-admin/non-superuser users from changing their own role
        if (!$currentUser->role === 'admin' && !$currentUser->is_superuser &&
            $this->has('role') && $this->input('role') !== $user->role) {
            $validator->errors()->add('role', 'You do not have permission to change roles.');
        }

        // Prevent the last admin from being demoted
        if ($user->role === 'admin' && $this->input('role') === 'user') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                $validator->errors()->add('role', 'Cannot demote the last admin user.');
            }
        }

        // Prevent non-superusers from changing superuser status
        if (!$currentUser->is_superuser && $this->has('is_superuser')) {
            $validator->errors()->add('is_superuser', 'You do not have permission to change superuser status.');
        }

        // Prevent removing the last superuser
        if ($user->is_superuser && $this->has('is_superuser') && !$this->input('is_superuser')) {
            $superuserCount = User::where('is_superuser', true)->count();
            if ($superuserCount <= 1) {
                $validator->errors()->add('is_superuser', 'Cannot remove the last superuser.');
            }
        }
    }
}
