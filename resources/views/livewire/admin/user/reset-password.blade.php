<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900">{{ $user->name }}'s Reset Password</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="save">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="password" value="{{ __('New Password') }}" />
                            <x-input  wire:model.lazy="password" id="password" type="password"
                                class="mt-1 block w-full" />
                            @error('password')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-input  wire:model.lazy="password_confirmation" id="password_confirmation" type="password"
                                class="mt-1 block w-full" />
                            @error('password_confirmation')
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
