<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'nic' => ['required', 'string', 'unique:users'],
            'is_business' => ['boolean'],
            'business_name' => ['nullable', 'string', 'max:255', 'required_if:is_business,true'],
            'business_registration_number' => ['nullable', 'string', 'max:255', 'unique:businesses,business_registration_number', 'required_if:is_business,true'],
            'certificate_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048', 'required_if:is_business,true'],    
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'nic' => $input['nic'],
                'phone' => $input['phone'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                if (!empty($input['is_business']) && $input['is_business'] === true) {
                    $user->assignRole('business');
    
                    // Handle File Upload
                    $certificatePath = null;
                    if (isset($input['certificate_file'])) {
                        $certificatePath = $input['certificate_file']->store('business_certificates', 'public');
                    }
    
                    // Create Business Record
                    $user->business()->create([
                        'business_name' => $input['business_name'],
                        'business_registration_number' => $input['business_registration_number'],
                        'certificate_file' => $certificatePath,
                    ]);
                } else {
                    $user->assignRole('user');
                }
            });
        });
    }
}
