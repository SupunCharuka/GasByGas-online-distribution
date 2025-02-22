<?php

namespace App\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    use PasswordValidationRules;
    public string $phone_iso = 'lk';
    use WithFileUploads;
    
    public array $state = [
        "name" => null,
        "email" => null,
        "phone" => null,
        "nic" => null,
        "business_name" => null,
        "business_registration_number" => null,
        "certificate_file" => null, 
        "is_business" => false,
        "password" => null,
        "terms" => null,
    ];

    protected function rules(): array
    {
        return [
            'state.name' => ['required', 'string', 'max:255'],
            'state.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'state.nic' => ['required', 'string', 'max:255', 'unique:users,nic'],
            'state.phone' => ['required', 'string', 'unique:users,phone','phone:' . $this->phone_iso],
            'state.is_business' => ['boolean'],
            'state.business_name' => ['nullable', 'string', 'max:255', 'required_if:state.is_business,true'],
            'state.business_registration_number' => ['nullable', 'string', 'max:255', 'unique:businesses,business_registration_number', 'required_if:state.is_business,true'],
            'state.certificate_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048', 'required_if:state.is_business,true'],    
            'state.password' => $this->passwordRules(),
            'state.terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'name',
        'state.email' => 'email',
        'state.nic' => 'NIC',
        'state.password' => 'password',
        'state.phone' => 'phone number',
        'state.terms' => 'terms',
    ];

    protected $messages = [
        'state.email.unique' => 'You have already added this email!',
        'state.nic.unique' => 'You have already added this nic!',
        'state.phone.unique' => 'You have already added this phone number!',
        'state.phone' => 'Please enter a valid phone number.',
        'state.business_registration_number.required_if' => 'The business registration number is required when registering as a business.',
        'state.business_name.required_if' => 'The business name is required when registering as a business.',
        'state.certificate_file.required_if' => 'The business certificate file is required when registering as a business.',
    ];


    public function updated()
    {
        $this->validate();
    }


    public function register(CreatesNewUsers $creator)
    {
        $this->validate();
        event(new Registered($user = $creator->create($this->state)));
        Auth::login($user);
        return app(RegisterResponse::class);
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
