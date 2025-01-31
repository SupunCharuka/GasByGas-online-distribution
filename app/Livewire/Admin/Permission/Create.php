<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{

    public $name;

    protected $rules = [
        'name' => 'required|unique:permissions,name',
    ];


    protected $validationAttributes = [
        'name' => 'permission name',
    ];

    protected $messages = [
        'name.unique' => 'You have already added this permission!',
    ];

    public function updated()
    {
        $this->validate();
    }


    public function save()
    {
        $this->validate();

        $permission =  Permission::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);
        $this->dispatch('permission-created', permission:  $permission);
        session()->flash('message', 'Permission has been created successfully!');
        $this->reset('name'); // Reset the input field
    }

    public function render()
    {
        return view('livewire.admin.permission.create');
    }
}
