<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(){
        return view('listings.index',[
            // ! List all the items on page without pagination
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            // 'listings' => Listing::all()

            // ! List all the items with pagination
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(3)

            // ! simplePagination style
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(2)


        ]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show',[
            'listing' => $listing
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
        // dd($request->user_id);

        $formField = $request->validate([
            'company' => ['required', Rule::unique('listings','company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required','email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);
        // dd($request->File('logo')->store('public'));

        // $formField['user_id'] = $request->user_id;
        $formField['user_id'] = auth()->id();
        // dd(auth()->id());



        if ($request->hasFile('logo'))
        {
            $formField['logo'] = $request->File('logo')->store('logos','public');
        }

        // dd($formField['logo']);


        Listing::create($formField);

        return redirect('/')->with('message','Job has been submit successfully');
    }

    public function edit(Listing $listing)
    {
        // dd($listing->description);
        return view('listings.edit',[
            'listing' => $listing
        ]);
    }

    // Update
    public function update(Request $request, Listing $listing){
        //  dd($request->user_id);

        if ($listing->user_id != auth()->id()) {
            abort('403', 'Unauthorized');
        }

        $formField = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => ['required','email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);
        // dd($request->File('logo')->store('public'));


        if ($request->hasFile('logo'))
        {
            $formField['logo'] = $request->File('logo')->store('logos','public');
        }

        $formField['user_id'] = $request->user_id;

        // dd($formField['logo']);


        $listing->update($formField);

        // return back()->with('message','Job has been edited successfully');
        return redirect('/listings/'. $listing->id)->with('message','Job has been edited successfully');

    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort('403', 'Unauthorized');
        }
        
        $listing->delete();

        return redirect('/')->with('message','Job has been deleted');
    }

    public function manage()
    {
        // $user = User::find(auth()->user()->id);
        return view('listings.manage',['listings' => auth()->user()->listing()->get()]);

        // this method is giving me a warrning but it still works
        // dd(auth()->user()->listings()->get());
      
        // found this method with tinker will use it to hide the warrning
        // $user = User::find(auth()->user()->id);
        
        // return view('listings.manage',[
        //     'listings' => $user->listings
        // ]);
    }
}
