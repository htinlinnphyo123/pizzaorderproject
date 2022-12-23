<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //contact page redirect
    public function contactPage(){
        return view('user.contact.contact');
    }

    //contact store
    public function sendMessage(Request $request){
        $this->validationSendMessage($request);
        $data = $this->getContactData($request);
        Contact::create($data);
        return back()->with(['successContact'=>'Contact Received. We will reply to you as soon as possible']);
    }


    //get contact data from user
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
    }


    //validation for send message
    private function validationSendMessage($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'terms' => 'accepted'
        ],[
            'terms.accepted' => 'You must agree to the terms and conditions of our terms.'
        ])->validate();
    }


}
