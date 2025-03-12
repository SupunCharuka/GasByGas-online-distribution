<?php

namespace App\Livewire\User\GasRequests;

use App\Mail\GasRequestCreated;
use App\Models\District;
use App\Models\GasRequest;
use App\Models\Outlet;
use App\Models\Token;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $outlet_id;
    public $district_id;
    public $quantity;
    public $gas_size;
    public $selectedOutletStock = 0;
    public $districts;
    public array $listForFields = [];

    public array $gasSizes = [
        '12.5kg' => '12.5 KG',
        '5kg' => '5 KG',
        '2.3kg' => '2.3 KG',
    ];

    protected $rules = [
        'district_id' => 'required|exists:districts,id',
        'outlet_id' => 'required|exists:outlets,id',
        'quantity' => 'required|integer|min:1',
        'gas_size' => 'required',
    ];

    protected $validationAttributes = [
        'district_id' => 'district',
        'outlet_id' => 'outlet',
        'quantity' => 'quantity',
        'gas_size' => 'gas size',
    ];

    public function mount()
    {
        $this->listForFields['districts'] = District::orderBy('name')->get();
        $this->listForFields['outlets'] = Outlet::where('district_id', $this->district_id)->orderBy('name')->get();
    }

    public function updatingDistrictId($value)
    {

        $this->outlet_id = null;
        $this->listForFields['outlets'] = Outlet::where('district_id', $value)->orderBy('name')->get();
        $this->selectedOutletStock = 0;
    }


    public function updatingOutletId($value)
    {
        $outlet = Outlet::find($value);
        $this->selectedOutletStock = $outlet ? $outlet->stock : 0;
    }


    public function submitRequest()
    {
        $this->validate();
        $userId = auth()->id();

        $existingRequest = GasRequest::where('user_id', $userId)
            ->whereIn('status', ['pending', 'scheduled'])
            ->exists();

        if ($existingRequest) {
            Session::flash('error', "You already have an active gas request. Please complete it before submitting a new one.");
            return;
        }

        $outlet = Outlet::find($this->outlet_id);
        if ($outlet->stock < $this->quantity) {
            Session::flash('error', 'Insufficient stock at the selected outlet.');
            return;
        }

        // Create the gas request
        $gasRequest = GasRequest::create([
            'user_id' => $userId,
            'outlet_id' => $this->outlet_id,
            'quantity' => $this->quantity,
            'gas_size' => $this->gas_size,
            'status' => 'pending',

        ]);

        // Find the Outlet Manager
        $outletManager = $outlet->users()->whereHas('roles', function ($query) {
            $query->where('name', 'outlet-manager');
        })->first();

        // Send email notification to the Outlet Manager
        if ($outletManager) {
            Mail::to($outletManager->email)->send(new GasRequestCreated($gasRequest));
        }

        $this->dispatch('gasRequest-created', gasRequest: $gasRequest);
        $this->reset(['district_id', 'outlet_id', 'quantity']);


        Session::flash('message', 'Gas request submitted successfully!');
    }


    public function render()
    {
        return view('livewire.user.gas-requests.create');
    }
}
