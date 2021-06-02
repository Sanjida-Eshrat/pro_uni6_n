<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Contact;
use App\Model\Logo;
use App\Model\Emails;
use Mail;

class ContactController extends Controller
{
    public function view()
    {	
    	$data['countContact']=Contact::count();
    	$data['allData']=Contact::all();
    	return view('frontend.contact.view-contact',$data);
    }

    public function add()
    {
    	return view('frontend.contact.add-contact');
    }

    public function store(Request $request)
    {
    	$data = new Contact();
    	$data->location = $request->location;
    	$data->email = $request->email;
    	$data->phone = $request->phone;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	return redirect()->route('contacts.view')->with('success','Data inserted successfully!');
    }

    public function edit($id)
    {
    	$editData = Contact::find($id);
    	return view('frontend.contact.add-contact',compact('editData'));
    }

    public function update(Request $request,$id)
    {
    	$data = Contact::find($id);
    	$data->location = $request->location;
    	$data->email = $request->email;
    	$data->phone = $request->phone;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	return redirect()->route('contacts.view')->with('success','Data updated successfully!');
    }

    public function delete($id)
    {
        $contact  = Contact::find($id);
        $contact->delete();
        return redirect()->route('contacts.view')->with('success','Data deleted successfully!');

    }

    public function storeMail(Request $request)
    {
        $mail = new Emails();
        $mail->name = $request->name;
        $mail->email = $request->email;
        $mail->subject = $request->subject;
        $mail->message = $request->message;
        $mail->save();

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        );

        Mail::send('frondend.emails.contact',$data,function($message) use($data){
            $message->from('sanjida.kh023@gmail.com','IST');
            $message->to($data['email']);
            $message->subject('Thanks for contacting us');
        });

        return redirect()->back()->with('success','Your message was successfully sent.');
    }

}
