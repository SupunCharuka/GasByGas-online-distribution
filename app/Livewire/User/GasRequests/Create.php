<?php

namespace App\Livewire\User\GasRequests;

use App\Models\District;
use App\Models\GasRequest;
use App\Models\Outlet;
use App\Models\Token;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $outlet_id;
    public $district_id;
    public $quantity;
    public $selectedOutletStock = 0;
    public $districts;
    public array $listForFields = [];

    protected $rules = [
        'district_id' => 'required|exists:districts,id',
        'outlet_id' => 'required|exists:outlets,id',
        'quantity' => 'required|integer|min:1',
    ];

    protected $validationAttributes = [
        'district_id' => 'district',
        'outlet_id' => 'outlet',
        'quantity' => 'quantity',

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


        $outlet = Outlet::find($this->outlet_id);
        if ($outlet->stock < $this->quantity) {
            Session::flash('error', 'Insufficient stock at the selected outlet.');
            return;
        }

        // Create the gas request
        $gasRequest = GasRequest::create([
            'user_id' => auth()->id(),
            'outlet_id' => $this->outlet_id,
            'quantity' => $this->quantity,
            'status' => 'pending',
            'token' => Str::uuid(),
            'expected_pickup_date' => now()->addWeeks(2),
        ]);
        $this->createToken($gasRequest);
        $this->dispatch('gasRequest-created', gasRequest: $gasRequest);
        $this->reset(['district_id', 'outlet_id', 'quantity']);


        Session::flash('message', 'Gas request submitted successfully!');
    }

    public function createToken(GasRequest $gasRequest)
    {

        $outlet = Outlet::find($gasRequest->outlet_id);

        if ($outlet && $outlet->stock >= $gasRequest->quantity) {

            $tokenNumber = Str::uuid();

            // Create the token
            $token = Token::create([
                'user_id' =>  auth()->id(),
                'gas_request_id' => $gasRequest->id,
                'token_number' => $tokenNumber,
                'status' => 'active',
            ]);


            //$outlet->decrement('stock', $gasRequest->quantity);


            Session::flash('warning', "Token generated successfully: $tokenNumber");
        } else {
            Session::flash('error', 'No stock available at this outlet.');
        }
    }


    public function render()
    {
        return view('livewire.user.gas-requests.create');
    }
}
