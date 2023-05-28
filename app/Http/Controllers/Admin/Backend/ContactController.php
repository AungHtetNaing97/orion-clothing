<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.contacts.index', compact('contacts'));
    }

    public function show($contactId)
    {
        $contact = Contact::find($contactId)->first();
        return view('admin.backend.contacts.show')->with('contact', $contact);
    }

    public function destroy($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $contact->delete();
        return response()->json(['message' => "User's contact is deleted successfully!"]);
    }
}
