<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Product;
class HomeController extends Controller
{

    public function index()
    {
        return view('index');
    }
    public function contact()
    {
        return view('user.contact');
    }
    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:11',
            'comment' => 'required'
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->comment = $request->comment;
        $contact->save();
        return redirect()->back()->with('success','Your message has been sent successfully');
    }
    public function search(Request $request){
        $query=$request->input('query');
        $results = Product::where('name','like',"%{$query}%")->get ()->take(8);
        return response()->json($results);

    }

}
