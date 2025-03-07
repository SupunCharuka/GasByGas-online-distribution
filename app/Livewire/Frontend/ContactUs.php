<?php

namespace App\Livewire\Frontend;

use App\Models\Contact;
use Livewire\Component;

class ContactUs extends Component
{
    public $name, $email, $message;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'message' => ['required', 'string'],
        ];
    }

    protected $validationAttributes = [
        'name' => "Name",
        'email' => "Email",
        'message' => "Message",
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        // Clear form fields
        $this->reset(['name', 'email', 'message']);

        session()->flash('success', 'Thank You! Your message has been sent.');
    }

    public function render()
    {
        return view('livewire.frontend.contact-us');
    }
}
