<?php

namespace App\Livewire\Admin\Outlet;

use App\Models\District;
use App\Models\Outlet;
use Livewire\Component;

class Edit extends Component
{
    public $outletId;
    public $name;
    public $district_id;
    public $address;
    public $contact_number;
    public $stock;


    protected $rules = [
        'name' => 'required|string|max:255',
        'district_id' => 'required|exists:districts,id',
        'address' => 'required|string|max:255',
        'contact_number' => 'required|string|max:15',
        'stock' => 'required|integer|min:0',
    ];

    protected $validationAttributes = [
        'name.required' => 'The outlet name is required.',
        'district.required' => 'The district is required.',
        'address.required' => 'The address is required.',
        'contact_number.required' => 'The contact number is required.',
        'stock.required' => 'The stock is required.',
    ];
    
    public function mount(Outlet $outlet) {
        $this->outletId = $outlet->id;
        $this->name = $outlet->name;
        $this->district_id = $outlet->district_id;
        $this->address = $outlet->address;
        $this->contact_number = $outlet->contact_number;
        $this->stock = $outlet->stock;
        
    }

    
    public function update() {
        $this->validate();

        $outlet = Outlet::findOrFail($this->outletId);
        $outlet->update([
            'name' => $this->name,
            'district_id' => $this->district_id,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
            'stock' => $this->stock,
        ]);

        // Show success message
        session()->flash('message', 'Outlet updated successfully!');
    }


    public function render()
    {
        return view('livewire.admin.outlet.edit', [
            'districts' => District::all(), // Fetch districts dynamically
        ]);
    }
}
