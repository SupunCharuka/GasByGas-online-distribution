<?php

namespace App\Livewire\Admin\User;

use App\Models\Outlet;
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
    public $selectedOutletDistrict = null;

    public $form = [
        'name'                  => '',
        'email'                 => '',
        'role_id'              => '',
        'phone'              => '',
        'outlet_id'             => null,
        'nic'              => '',
    ];

    protected function rules(): array
    {
        $rules = [
            'form.name'    => ['required', 'string', 'max:255'],
            'form.email'     =>  ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'form.nic' => ['required', 'string', 'regex:/^[0-9]{9}[vVxX]$|^[0-9]{12}$/', Rule::unique('users', 'nic')->ignore($this->user->id)],
            'form.role_id' => ['required', 'integer', 'exists:Spatie\Permission\Models\Role,id'],
            'form.phone' => ['required', 'string', Rule::unique('users', 'phone')->ignore($this->user->id), 'phone:' . $this->phone_iso],

        ];
        if ($this->form['role_id'] && Role::find($this->form['role_id'])->name === 'outlet-manager') {
            $rules['form.outlet_id'] = 'required|exists:outlets,id';
        }

        return $rules;
    }

    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email',
        'form.password' => 'password',
        'form.phone' => 'phone number',
        'form.role_id' => 'role',
        'form.outlet_id' => 'outlet',
        'form.nic' => 'nic',
    ];


    protected $messages = [
        'form.email.unique' => 'You have already added this email!',
        'form.nic.unique' => 'You have already added this nic!',
        'form.phone.unique' => 'You have already added this phone number!',
        'form.phone' => 'Please enter a valid phone number.',
    ];

    public function updated($field)
    {

        $this->validate();


        if ($field === 'form.outlet_id') {
            $outlet = Outlet::find($this->form['outlet_id']);
            $this->selectedOutletDistrict = $outlet->district->name ?? null;
        }
    }

    public function updatedFormRoleId($value)
    {
        if ($value && Role::find($value)->name !== 'outlet-manager') {
            $this->form['outlet_id'] = null;
            $this->selectedOutletDistrict = null;
        } elseif ($value && Role::find($value)->name === 'outlet-manager') {
            $this->filterAvailableOutlets();
        }
    }



    public function save()
    {
        $this->validate();

        $user = User::where('id', $this->user->id)->first();
        $user->name = $this->form['name'];
        $user->email = $this->form['email'];
        $user->nic = $this->form['nic'];
        $user->phone = $this->form['phone'];

        $this->role_id = [$this->form['role_id']];;
        $user->roles()->sync($this->role_id);
        $selectedRole = Role::find($this->form['role_id']);

        if ($selectedRole && $selectedRole->name === 'outlet-manager') {
            $user->outlet_id = $this->form['outlet_id'];
        } else {
            $user->outlet_id = null;
        }


        $user->save();

        session()->flash('message', 'User Updated Successfully!');
        return redirect()->route('admin.manage-user');
    }



    public function mount($user)
    {
        $this->user = $user;

        $this->form['name'] = $user->name;
        $this->form['email'] = $user->email;
        $this->form['nic'] = $user->nic;
        $this->form['phone'] = $user->phone;
        $this->form['role_id'] = $user->roles->first()->id ?? '';
        $this->form['outlet_id'] = $user->outlet_id;
        $this->role = new Role();

        $this->listForFields['outlets'] = [];

        if ($this->form['role_id'] && Role::find($this->form['role_id'])->name === 'outlet-manager') {
            $this->filterAvailableOutlets();
        }

        if ($this->form['outlet_id']) {
            $outlet = Outlet::find($this->form['outlet_id']);
            $this->selectedOutletDistrict = $outlet->district->name ?? null;
        }
    }

    private function filterAvailableOutlets()
    {
        $assignedOutletIds = User::whereNotNull('outlet_id')
            ->where('id', '!=', $this->user->id)
            ->pluck('outlet_id')
            ->toArray();

        $this->listForFields['outlets'] = Outlet::whereNotIn('id', $assignedOutletIds)
            ->pluck('name', 'id')
            ->toArray();
    }


    public function render()
    {
        return view('livewire.admin.user.edit');
    }
}
