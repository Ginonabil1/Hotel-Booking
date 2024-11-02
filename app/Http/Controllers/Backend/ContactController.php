<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Contact;

class ContactController extends Controller
{
    public function ContactUs(){
        return view('frontend.contact.contact_us');
     }// End Method

     public function StoreContactUs(Request $request){
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Your Message Send Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
     }// End Method

     public function ShowContact(){
        $contacts = Contact::latest()->get();
        return view('backend.contact.contact_us', compact('contacts'));
     }
}
