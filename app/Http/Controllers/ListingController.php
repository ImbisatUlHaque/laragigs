<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

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
        // dd($request->file('logo'));

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
        // dd($request->file('logo'));

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

        // dd($formField['logo']);


        $listing->update($formField);

        // return back()->with('message','Job has been edited successfully');
        return redirect('/listings/'. $listing->id)->with('message','Job has been edited successfully');

    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect('/')->with('message','Job has been deleted');
    }
}
