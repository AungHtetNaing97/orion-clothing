<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Contact;
use App\Models\UserDetail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ContactComponent extends Component
{
    public $userId;
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public function mount()
    {
        // Fetch the user's data from the database and assign it to the component properties
        $user = Auth::user();
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $userDetail = $user->userDetail;

        if ($userDetail) {
            $this->phone = $userDetail->phone;
        }
    }

    public function contact()
    {
        $validatedData = $this->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
            'phone' => ['required', 'string', 'regex:/^\+?\d{10,15}$/']
        ]);

        // Check if the user already has a UserDetail record
        $user = Auth::user();
        $userDetail = $user->userDetail;

        if (!$userDetail && $this->phone) {
            // Create user detail record only if the user doesn't have it and phone is provided
            UserDetail::create([
                'user_id' => $user->id,
                'phone' => $this->phone
            ]);
        }

        // Create the contact record
        Contact::create([
            'user_id' => $user->id,
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message']
        ]);

        session()->flash('message', 'Your message has been sent to us. We will connect with you soon!');

        // Clear the form fields
        $this->reset();

        // You can choose to return to the same page or redirect elsewhere
        return redirect('contactUs');
    }

    public function render()
    {
        return view('livewire.frontend.contact-component', [
            'user_id' => $this->userId,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone
        ]);
    }
}
