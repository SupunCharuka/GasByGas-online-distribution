<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card shadow md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900"> {{ __('Create User') }}</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="save">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="role_id" value="{{ __('Assign Role') }}" />
                            <select wire:model.lazy="form.role_id" id="role" type="text"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-control">
                                <option selected="" value="">Select role name</option>
                                @foreach ($role->all() as $key => $role)
                                  
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                   
                                @endforeach
                            </select>
                            @error('form.role_id')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input wire:model.lazy="form.name" id="name" type="text"
                                class="mt-1 block w-full" />
                            @error('form.name')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input wire:model.lazy="form.email" id="email" type="text"
                                class="mt-1 block w-full" />
                            @error('form.email')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="phone" value="{{ __('Phone Number') }}" />
                            <div wire:ignore>
                                <x-input wire:model.lazy="form.phone" id="phone" type="text"
                                    class="mt-1 block w-full" />
                            </div>
                            @error('form.phone')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        @if ($form['role_id'] && Spatie\Permission\Models\Role::find($form['role_id'])->name === 'outlet-manager')
                            <!-- Outlet Selection -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="outlet_id" value="{{ __('Assign Outlet') }}" />
                                <select wire:model.lazy="form.outlet_id" id="outlet_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-control">
                                    <option value="">Select Outlet</option>
                                    @foreach ($listForFields['outlets'] as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('form.outlet_id')
                                    <p class="text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            @if ($selectedOutletDistrict)
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label value="{{ __('Outlet District') }}" />
                                    <div class="mt-1 p-2 bg-gray-100 rounded-md">
                                        {{ $selectedOutletDistrict }}
                                    </div>
                                </div>
                            @endif
                        @endif


                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input wire:model.lazy="form.password" id="password" type="password"
                                class="mt-1 block w-full" />
                            @error('form.password')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm Passowrd') }}" />
                            <x-input wire:model.lazy="form.password_confirmation" id="password_confirmation"
                                type="password" class="mt-1 block w-full" />
                            @error('form.password_confirmation')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>



                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-4 py-3  text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                    <x-button wire:loading.attr="disabled">
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    (function() {
        window.addEventListener('DOMContentLoaded', (event) => {

            const __CREATE_USER = @this;
            let itl_phone

            function init(phone_iso = 'lk') {
                itl_phone && itl_phone.destroy();
                try {
                    return intlTelInput.intlTelInput(document.querySelector("#phone"), {
                        initialCountry: phone_iso,
                        formatOnDisplay: false,
                        autoPlaceholder: 'aggressive'
                    })
                } catch (e) {
                    console.log(e.message)
                    return init('us')
                }
            }

            itl_phone = init()

            document.querySelector("#phone").addEventListener('change', function(e) {
                let countryData = itl_phone.getSelectedCountryData();
                let phone = itl_phone.getNumber(intlTelInputUtils.numberFormat.E164);
                __CREATE_USER.set('phone_iso', countryData.iso2)
                __CREATE_USER.set('form.phone', phone);
                console.log('phone: change: ', countryData)
            })

            document.getElementById("phone").addEventListener("close:countrydropdown", function() {
                let countryData = itl_phone.getSelectedCountryData();
                let phone = itl_phone.getNumber(intlTelInputUtils.numberFormat.E164);
                __CREATE_USER.set('phone_iso', countryData.iso2)
                __CREATE_USER.set('form.phone', phone);
                console.log('countryChange: phone_iso: ', countryData)
            });

            Livewire.hook('element.updated', (message, component) => {
                if (component.serverMemo.data.step === 1) {
                    document.querySelector("#phone").value = component.serverMemo.data.form.phone;
                }
            });

        });
    })()
</script>
