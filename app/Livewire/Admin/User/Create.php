<?php

namespace App\Livewire\Admin\User;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use PasswordValidationRules;
    public User $user;
    public Role $role;
    public $role_id = [];
    public array $listForFields = [];
    public string $phone_iso = 'lk';

    public $form = [
        'name'                  => '',
        'email'                 => '',
        'password'              => '',
        'role_id'              => '',
        'phone'              => '',
       
    ];
    protected function rules(): array
    {
        return [
            'form.name'    => ['required', 'string', 'max:255'],
            'form.email'     =>  ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'form.password' => $this->passwordRules(),
            'form.role_id' => ['required', 'integer', 'exists:Spatie\Permission\Models\Role,id'],
            'form.phone' => ['required', 'string', 'unique:users,phone', 'phone:' . $this->phone_iso],

        ];
    }
    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email',
        'form.password' => 'password',
        'form.phone' => 'phone number',
        'form.role_id' => 'role',
    
    ];

    
    protected $messages = [
        'form.email.unique' => 'You have already added this email!',
        'form.phone.unique' => 'You have already added this phone number!',
        'form.phone' => 'Please enter a valid phone number.',
    ];


    private function resetInputFields()
    {

        $this->form['name'] = '';
        $this->form['email'] = '';
        $this->form['password'] = '';
        $this->form['password_confirmation'] = '';
        $this->form['phone'] = '';
        $this->form['role_id'] = '';

    }

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();
        $input = $this->form;
        $this->role_id = ['role_id' => $input['role_id']];
        $this->user = DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'phone' => $input['phone'],
               
            ]), function (User $user) {
                $user->roles()->sync($this->role_id);
            });
        });

        session()->flash('message', 'User Created Successfully!');
        return redirect()->route('admin.manage-user');
    }

   

    public function mount()
    {
        $this->user = new User();
        $this->role = new Role();
      
    }
    public function render()
    {
        return view('livewire.admin.user.create');
    }
}
