<?php

namespace App\Livewire\Admin\User;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Outlet;
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
    public $outlet_id;
    public Outlet $outlet;
    public $selectedOutletDistrict = null;

    public $form = [
        'name'                  => '',
        'email'                 => '',
        'password'              => '',
        'role_id'              => '',
        'phone'              => '',
        'nic'              => '',
        'outlet_id'             => '',

    ];
    protected function rules(): array
    {
        $rules =  [
            'form.name'    => ['required', 'string', 'max:255'],
            'form.email'     =>  ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'form.nic'     =>  ['required', 'string', 'regex:/^[0-9]{9}[vVxX]$|^[0-9]{12}$/', 'unique:users,nic'],
            'form.password' => $this->passwordRules(),
            'form.role_id' => ['required', 'integer', 'exists:Spatie\Permission\Models\Role,id'],
            'form.phone' => ['required', 'string', 'unique:users,phone', 'phone:' . $this->phone_iso],
        ];

        if ($this->form['role_id'] && Role::find($this->form['role_id'])->name === 'outlet-manager') {
            $rules['form.outlet_id'] = ['required', 'integer', 'exists:outlets,id'];
        }

        return $rules;
    }
    protected $validationAttributes = [
        'form.name' => 'name',
        'form.email' => 'email',
        'form.nic' => 'nic',
        'form.password' => 'password',
        'form.phone' => 'phone number',
        'form.role_id' => 'role',
        'form.outlet_id' => 'outlet',

    ];


    protected $messages = [
        'form.email.unique' => 'You have already added this email!',
        'form.nic.unique' => 'You have already added this nic!',
        'form.phone.unique' => 'You have already added this phone number!',
        'form.phone' => 'Please enter a valid phone number.',
        'form.outlet_id.required' => 'The outlet field is required for outlet managers.',
    ];


    private function resetInputFields()
    {

        $this->form['name'] = '';
        $this->form['email'] = '';
        $this->form['nic'] = '';
        $this->form['password'] = '';
        $this->form['password_confirmation'] = '';
        $this->form['phone'] = '';
        $this->form['role_id'] = '';
        $this->form['outlet_id'] = '';
        $this->selectedOutletDistrict = null;
    }

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
        if ($propertyName === 'form.outlet_id') {
            $this->selectedOutletDistrict = Outlet::find($this->form['outlet_id'])->district->name ?? null;
        }
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
                'nic' => $input['nic'],
                'password' => Hash::make($input['password']),
                'phone' => $input['phone'],
                'outlet_id' => !empty($input['outlet_id']) ? (int) $input['outlet_id'] : null,
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
        $this->outlet = new Outlet();

        $assignedOutletIds = User::whereNotNull('outlet_id')->pluck('outlet_id')->toArray();

        $this->listForFields['outlets'] = Outlet::whereNotIn('id', $assignedOutletIds)
            ->pluck('name', 'id')
            ->toArray();
    }
    public function render()
    {
        return view('livewire.admin.user.create');
    }
}
