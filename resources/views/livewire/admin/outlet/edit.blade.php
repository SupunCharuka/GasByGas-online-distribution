<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card shadow md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900"> {{ __('Edit Outlet') }}</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="update">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Outlet Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="{{ __('Outlet Name') }}" />
                            <x-input wire:model="name" id="name" type="text" class="mt-1 block w-full" />
                            @error('name')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- District Dropdown -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="district_id" value="{{ __('District') }}" />
                            <select wire:model="district_id" id="district_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $district->id == $district_id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('district_id')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input wire:model="address" id="address" type="text" class="mt-1 block w-full" />
                            @error('address')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="contact_number" value="{{ __('Contact Number') }}" />
                            <x-input wire:model="contact_number" id="contact_number" type="text"
                                class="mt-1 block w-full" />
                            @error('contact_number')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="stock" value="{{ __('Stock') }}" />
                            <x-input wire:model="stock" id="stock" type="number" class="mt-1 block w-full"
                                min="0" />
                            @error('stock')
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
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
