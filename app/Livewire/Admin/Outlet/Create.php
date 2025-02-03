<?php

namespace App\Livewire\Admin\Outlet;

use App\Models\District;
use App\Models\Outlet;
use Livewire\Component;

class Create extends Component
{

    public $name;
    public $district_id;
    public $address;
    public $contact_number;
    public $stock;
    public $districts;

    protected $rules = [
        'name' => 'required|string|max:255',
        'district_id' => 'required|exists:districts,id',
        'address' => 'required|string|max:255',
        'contact_number' => 'required|string|max:15',
        'stock' => 'required|integer|min:0',
    ];

    protected $validationAttributes = [
        'name.required' => 'The outlet name is required.',
        'district_id.required' => 'The district is required.',
        'address.required' => 'The address is required.',
        'contact_number.required' => 'The contact number is required.',
        'stock.required' => 'The stock is required.',
    ];


    public function save()
    {
        $this->validate();

        $outlet = Outlet::create([
            'name' => $this->name,
            'district_id' => $this->district_id,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
            'stock' => $this->stock,
        ]);

        $outlet->load('district');


        $this->dispatch('outlet-created', outlet: [
            'id' => $outlet->id,
            'name' => $outlet->name,
            'district' => $outlet->district->name, 
            'address' => $outlet->address,
            'contact_number' => $outlet->contact_number,
            'stock' => $outlet->stock,
        ]);

        $this->reset(['name', 'district_id', 'address', 'contact_number', 'stock']);


        session()->flash('message', 'Outlet created successfully!');
    }

    public function mount()
    {
        $this->districts = District::all();
    }

    public function render()
    {
        return view('livewire.admin.outlet.create');
    }
}
