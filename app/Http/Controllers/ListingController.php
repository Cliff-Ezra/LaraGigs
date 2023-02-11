<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show form to create new listing
    public function create(){
        return view('listings.create');
    }

    // Store new listing data
    public function store(Request $request) {
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // Check if logo is uploaded & store it
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        
        //Static method
        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show form to edit listing
    public function edit(Listing $listing) {
        // dd($listing->title);
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    // Update listing data
    public function update(Request $request, Listing $listing) {
        // dd($request->file('logo'));

        //Make sure Logged in user is the owner of the listing
        if($listing->user_id !==auth()->id()) {
            abort(403, 'You are not authorized to edit this listing!');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // Check if logo is uploaded & store it
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //Adding a user id to the form fields
        // $formFields['user_id'] = auth()->id;
        
        // Regular method
        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete listing
    public function destroy(Listing $listing) {
        //Make sure Logged in user is the owner of the listing
        if($listing->user_id !==auth()->id()) {
            abort(403, 'You are not authorized to edit this listing!');
        }
        
        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

     // Manage Listings
     public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}