<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Models\Contact;
use App\Notifications\NewContact;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.contact.index');
    }

    public function Contato(ContactFormRequest $request) {
        $contact = Contact::create($request->all());
        Notification::route('mail', config('mail.from.address'))->notify(new NewContact($contact));    
        
        // return redirect()->route('site.contact')->with(['success' => true, 'message' => 'O contato foi enviado com sucesso.']);

        toastr()->success('O contato foi criado com sucesso!');
        return back()->with([
            'success' => true,
            'message' => 'O contato foi criado com sucesso!'
        ]);
        
    }
}
