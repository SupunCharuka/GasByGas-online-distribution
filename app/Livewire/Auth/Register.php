<?php

namespace App\Livewire\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class Register extends Component
{
    use PasswordValidationRules;
    public string $phone_iso = 'lk';
    
    public array $state = [
        "name" => null,
        "email" => null,
        "phone" => null,
        "nic" => null,
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
            'state.password' => $this->passwordRules(),
            'state.terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];
    }

    protected $validationAttributes = [
        'state.name' => 'Name',
        'state.email' => 'Email',
        'state.nic' => 'NIC',
        'state.password' => 'Password',
        'state.phone' => 'Phone number',
        'state.terms' => 'Terms',
    ];

    protected $messages = [
        'state.email.unique' => 'You have already added this email!',
        'state.nic.unique' => 'You have already added this nic!',
        'state.phone.unique' => 'You have already added this phone number!',
        'state.phone' => 'Please enter a valid phone number.',
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
