<?php

namespace App\Livewire\Admin\User;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    use PasswordValidationRules;

    public $user;

    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'password' => $this->passwordRules(),
        ];
    }

    public function validationAttributes()
    {
        return [
            'password' => 'new password',
            'password_confirmation' => 'confirm password',
        ];
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'Password updated successfully.');
    }
    public function render()
    {
        return view('livewire.admin.user.reset-password');
    }
}
