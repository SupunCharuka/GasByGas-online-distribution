<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    
    public User $user;
    public Role $role;
    public $role_id = [];
    public array $listForFields = [];
    public string $phone_iso = 'lk';


    public $form = [
        'name'                  => '',
        'email'                 => '',
        'role_id'              => '',
        'phone'              => '',
      
    ];

    protected function rules(): array
    {
        return [
            'form.name'    => ['required', 'string', 'max:255'],
            'form.email'     =>  ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'form.role_id' => ['required', 'integer', 'exists:Spatie\Permission\Models\Role,id'],
            'form.phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($this->user->id), 'phone:' . $this->phone_iso],
           
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

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();

        $users = User::where('id', $this->user->id)->first();
        $users->name = $this->form['name'];
        $users->email = $this->form['email'];
        $users->phone = $this->form['phone'];
     
        $this->role_id = [$this->form['role_id']];;
        $users->roles()->sync($this->role_id);
        $users->update();

        session()->flash('message', 'User Updated Successfully!');
        return redirect()->route('admin.manage-user');
    }

    

    public function mount($user)
    {
        $this->user = $user;

        $this->form['name'] = $user->name;
        $this->form['email'] = $user->email;
        $this->form['phone'] = $user->phone;
        $this->form['role_id'] = $user->roles->first()->id ?? '';

        $this->role = new Role();

    
    }
    public function render()
    {
        return view('livewire.admin.user.edit');
    }
}
