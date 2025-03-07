<div class="col-lg-8">
    @if (session()->has('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif
    <form wire:submit.prevent="store" class="php-email-form">
        <div class="row gy-4">

            <div class="col-md-6">
                <input wire:model.lazy="name" id="name" type="text" name="name" class="form-control"
                    placeholder="Your Name" required="">
                @error('name')
                    <span class="text-danger mt-2"><i class="fas fa-exclamation-circle mr-1"
                            aria-hidden="true"></i>{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <input wire:model.lazy="email" id="email" type="email" class="form-control" name="email"
                    placeholder="Your Email" required="">
                @error('email')
                    <span class="text-danger mt-2"><i class="fas fa-exclamation-circle mr-1"
                            aria-hidden="true"></i>{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <textarea wire:model.lazy="message" class="form-control" name="message" rows="6" placeholder="Message"
                    required=""></textarea>
                @error('message')
                    <span class="text-danger mt-2"><i class="fas fa-exclamation-circle mr-1"
                            aria-hidden="true"></i>{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 text-center">
                <button wire:loading.attr="disabled" class="theme-btn border-0" type="submit">
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Sending
                    </span>
                </button>
            </div>

        </div>
    </form>
</div>
