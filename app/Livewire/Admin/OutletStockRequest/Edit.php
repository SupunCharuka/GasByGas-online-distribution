<?php

namespace App\Livewire\Admin\OutletStockRequest;

use App\Models\OutletStockRequest;
use Livewire\Component;

class Edit extends Component
{
    public $stockRequest;
    public $empty_cylinders, $filled_cylinders, $requested_cylinders;

    public function mount(OutletStockRequest $stockRequest)
    {
        $this->stockRequest = $stockRequest;
        $this->empty_cylinders = $stockRequest->empty_cylinders;
        $this->filled_cylinders = $stockRequest->filled_cylinders;
        $this->requested_cylinders = $stockRequest->requested_cylinders;
    }

    public function save()
    {
        $this->validate([
            'empty_cylinders' => 'required|integer|min:0',
            'filled_cylinders' => 'required|integer|min:0',
            'requested_cylinders' => 'required|integer|min:0',
        ]);

        $this->stockRequest->update([
            'empty_cylinders' => $this->empty_cylinders,
            'filled_cylinders' => $this->filled_cylinders,
            'requested_cylinders' => $this->requested_cylinders,
            'status' => 'pending',
        ]);

        session()->flash('message', 'Stock request updated successfully.');

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.stock-request.adminIndex');
        }else{
            return redirect()->route('admin.outlet-stock-request');
        }   
      
    }

    public function render()
    {
        return view('livewire.admin.outlet-stock-request.edit');
    }
}
