<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('warning'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('warning') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="card shadow md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900"> {{ __('Request Gas') }}</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="submitRequest">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="district_id" value="{{ __('Select District') }}" />
                            <select wire:model.lazy="district_id" id="district_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select District</option>
                                @foreach ($listForFields['districts'] as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @error('district_id')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="outlet_id" value="{{ __('Select Outlet') }}" />
                            <select wire:model.lazy="outlet_id" id="outlet_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Outlet</option>
                                @foreach ($listForFields['outlets'] as $outlet)
                                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label value="{{ __('Available Stock') }}" />
                            <div class="mt-1 p-2 bg-gray-100 rounded-md">
                                @if ($selectedOutletStock > 0)
                                    <span class="text-gray-700 font-bold">{{ $selectedOutletStock }} cylinders
                                        available</span>
                                @else
                                    <span class="text-red-600 font-bold">Out of Stock</span>
                                @endif
                            </div>
                        </div>



                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="quantity" value="{{ __('Quantity') }}" />
                            <x-input wire:model.lazy="quantity" id="quantity" type="number" class="mt-1 block w-full"
                                min="1" />
                            @error('quantity')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-4 py-3 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                    <x-button wire:loading.attr="disabled">
                        {{ __('Submit Request') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
