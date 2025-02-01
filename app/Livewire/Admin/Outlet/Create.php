<?php

namespace App\Livewire\Admin\Outlet;

use App\Models\Outlet;
use Livewire\Component;

class Create extends Component
{

    public $name;
    public $district;
    public $address;
    public $contact_number;

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
    ];

    protected $validationAttributes = [
        'name.required' => 'The outlet name is required.',
        'district.required' => 'The district is required.',
        'address.required' => 'The address is required.',
        'contact_number.required' => 'The contact number is required.',
    ];


    public function save()
    {
        $this->validate();

       $outlet = Outlet::create([
            'name' => $this->name,
            'district' => $this->district,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
        ]);
        $this->dispatch('outlet-created', outlet:  $outlet);
        
        $this->reset(['name', 'district', 'address', 'contact_number']);

    
        session()->flash('message', 'Outlet created successfully!');
    }


    public function render()
    {
        return view('livewire.admin.outlet.create', [
            'districts' => $this->districts,
        ]);
    }
}
