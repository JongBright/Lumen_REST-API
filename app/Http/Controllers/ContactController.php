<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class ContactController extends Controller
{
    //get all data from db
    public function index()
    {
        $contacts = Contact::all();

        return response()->json($contacts);
    }

    
    //add data to the db
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:contacts,phone,2,id'
        ]);
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->phone = $request->input('phone');
        $contact->save();

        return response()->json($contact);
    }

    
    //get specific data (one row) from the db
    public function show($id)
    {
        $contact = Contact::find($id);
        
        return response()->json($contact);
    }

   
    //update specific row in the db
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:contacts,phone,2,id'
        ]);
        $contact = Contact::find($id);
        $contact->name = $request->input('name');
        $contact->phone = $request->input('phone');
        $contact->save();

        return response()->json($contact);

    }

    
    //delete specific row from the db
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        
        return response()->json('Contact has been deleted successfully!');
    }
}
