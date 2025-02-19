<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="card shadow md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900"> {{ __('Outlet Request ') }}</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="save">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="empty_cylinders" value="{{ __('Empty Cylinders') }}" />
                            <x-input wire:model="empty_cylinders" id="empty_cylinders" type="text"
                                class="mt-1 block w-full" />
                            @error('empty_cylinders')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="filled_cylinders" value="{{ __('Filled Cylinders') }}" />
                            <x-input wire:model="filled_cylinders" id="filled_cylinders" type="text"
                                class="mt-1 block  w-full" />
                            @error('filled_cylinders')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="requested_cylinders" value="{{ __('Requested Cylinders') }}" />
                            <x-input wire:model="requested_cylinders" id="requested_cylinders" type="text"
                                class="mt-1 block w-full" />
                            @error('requested_cylinders')
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
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
