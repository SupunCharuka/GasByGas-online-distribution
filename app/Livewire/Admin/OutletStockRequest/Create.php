<?php

namespace App\Livewire\Admin\OutletStockRequest;

use App\Models\GasRequest;
use App\Models\Outlet;
use App\Models\OutletStockRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $empty_cylinders;
    public $filled_cylinders;
    public $requested_cylinders;
    public $current_stock;
    public $total_gas_requests;
    public $pending_stock_request_count;
    public $request_limit_exceeded = false;

    protected $rules = [
        'empty_cylinders' => 'required|integer|min:1',
        'filled_cylinders' => 'required|integer|min:1',
        'requested_cylinders' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $outlet = Outlet::find(Auth::user()->outlet_id);

        if ($outlet) {
            $this->current_stock = $outlet->stock;

            $this->total_gas_requests = GasRequest::where('outlet_id', $outlet->id)
                ->where('status', 'pending')
                ->sum('quantity');

            $this->pending_stock_request_count = OutletStockRequest::where('outlet_id', $outlet->id)
                ->where('status', 'pending')
                ->count();

            $this->request_limit_exceeded = $this->pending_stock_request_count >= 1;

            $this->filled_cylinders = $this->current_stock;
            $this->empty_cylinders = 0;


            $this->requested_cylinders = max($this->total_gas_requests - $this->current_stock, 0);
        } else {
            session()->flash('requested_cylinders', 'Outlet not found.');
        }
    }


    public function save()
    {

        if ($this->request_limit_exceeded) {
            session()->flash('error', 'You already have a pending stock request.');
            return;
        }

        $this->validate();

        OutletStockRequest::create([
            'outlet_id' => Auth::user()->outlet_id,
            'empty_cylinders' => $this->empty_cylinders,
            'filled_cylinders' => $this->filled_cylinders,
            'requested_cylinders' => $this->requested_cylinders,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Stock request submitted successfully.');

        // Reset form fields after submission
        $this->reset(['empty_cylinders', 'filled_cylinders', 'requested_cylinders']);
    }

    public function render()
    {
        return view('livewire.admin.outlet-stock-request.create');
    }
}
