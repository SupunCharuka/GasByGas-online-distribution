<?php

namespace App\Livewire\Admin\Permission;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public Permission $permission;
    public $name;

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('permissions', 'name')->ignore($this->permission->id, 'id')],
        ];
    }
    protected $validationAttributes = [
        'name' => 'permission Name',
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
        $this->permission->name = $this->name;
        $this->permission->save(); 
        session()->flash('message', 'permission has been updated successfully!');
    }
    public function mount( $permission)
    {
        $this->permission = $permission; 
        $this->name = $this->permission->name;
       
    }
    public function render()
    {
        return view('livewire.admin.permission.edit');
    }
}
