<section id="contact" class="contact section">
    <div class="container">
        <div class="row gy-4">


            <div class="flex items-center justify-center">

                <div class="col-lg-4">

                    <form wire:submit.prevent="register" class="php-email-form">
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input wire:model.lazy="state.name" id="name" class="block mt-1 w-full"
                                type="text" name="name" required autofocus autocomplete="name" />
                            @error('state.name')
                                <p class="font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input wire:model.lazy="state.email" id="email" class="block mt-1 w-full"
                                type="email" name="email" required />
                            @error('state.email')
                                <p class="font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="nic" value="{{ __('NIC') }}" />
                            <x-input wire:model.lazy="state.nic" id="nic" class="block mt-1 w-full" type="text"
                                name="nic" required />
                            @error('state.nic')
                                <p class="font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div class="mt-4" wire:ignore>
                            <x-label for="phone" value="{{ __('Phone Number') }}" />
                            <x-input wire:model.lazy="state.phone" id="phone" class="block mt-1 w-full"
                                type="text" name="phone" required style="padding-left: 52px" />
                        </div>
                        @error('state.phone')
                            <p class="font-medium text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input wire:model.lazy="state.password" id="password" class="block mt-1 w-full"
                                type="password" name="password" required autocomplete="new-password" />

                            @error('state.password')
                                <p class="font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-input wire:model.lazy="state.password_confirmation" id="password_confirmation"
                                class="block mt-1 w-full" type="password" name="password_confirmation" required
                                autocomplete="new-password" />
                            @error('state.password_confirmation')
                                <p class="font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox wire:model.lazy="state.terms" name="terms" id="terms"
                                            required />

                                        <div class="ms-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button class="ms-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        window.addEventListener('DOMContentLoaded', (event) => {

            const __REGISTER = @this;
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
                    return init('lk')
                }
            }

            itl_phone = init()

            document.querySelector("#phone").addEventListener('change', function(e) {
                let countryData = itl_phone.getSelectedCountryData();
                let phone = itl_phone.getNumber(intlTelInputUtils.numberFormat.E164);
                __REGISTER.set('phone_iso', countryData.iso2)
                __REGISTER.set('state.phone', phone);
                console.log('phone: change: ', countryData)
            })

            document.getElementById("phone").addEventListener("close:countrydropdown", function() {
                let countryData = itl_phone.getSelectedCountryData();
                let phone = itl_phone.getNumber(intlTelInputUtils.numberFormat.E164);
                __REGISTER.set('phone_iso', countryData.iso2)
                __REGISTER.set('state.phone', phone);
                console.log('countryChange: phone_iso: ', countryData)
            });

            Livewire.hook('element.updated', (message, component) => {
                if (component.serverMemo.data.step === 1) {
                    document.querySelector("#phone").value = component.serverMemo.data.state.phone;
                }
            });

        });
    })()
</script>
