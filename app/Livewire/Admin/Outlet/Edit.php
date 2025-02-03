<?php

namespace App\Livewire\Admin\Outlet;

use App\Models\Outlet;
use Livewire\Component;

class Edit extends Component
{
    public $outletId;
    public $name;
    public $district;
    public $address;
    public $contact_number;
    public $stock;

    // Hardcoded list of Sri Lanka districts
    public $districts = [
        'Ampara',
        'Anuradhapura',
        'Badulla',
        'Batticaloa',
        'Colombo',
        'Galle',
        'Gampaha',
        'Hambantota',
        'Jaffna',
        'Kalutara',
        'Kandy',
        'Kegalle',
        'Kilinochchi',
        'Kurunegala',
        'Mannar',
        'Matale',
        'Matara',
        'Moneragala',
        'Mullaitivu',
        'Nuwara Eliya',
        'Polonnaruwa',
        'Puttalam',
        'Ratnapura',
        'Trincomalee',
        'Vavuniya',
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'district' => 'required|string|in:' . 'Ampara,Anuradhapura,Badulla,Batticaloa,Colombo,Galle,Gampaha,Hambantota,Jaffna,Kalutara,Kandy,Kegalle,Kilinochchi,Kurunegala,Mannar,Matale,Matara,Moneragala,Mullaitivu,Nuwara Eliya,Polonnaruwa,Puttalam,Ratnapura,Trincomalee,Vavuniya',
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
        $this->district = $outlet->district;
        $this->address = $outlet->address;
        $this->contact_number = $outlet->contact_number;
        $this->stock = $outlet->stock;
        
    }

    
    public function update() {
        $this->validate();

        $outlet = Outlet::findOrFail($this->outletId);
        $outlet->update([
            'name' => $this->name,
            'district' => $this->district,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
            'stock' => $this->stock,
        ]);

        // Show success message
        session()->flash('message', 'Outlet updated successfully!');
    }


    public function render()
    {
        return view('livewire.admin.outlet.edit');
    }
}
