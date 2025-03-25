<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // ✅ Show listings
    public function index()
    {
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            // Admin sees all listings but cannot modify them
            $listings = Listing::paginate(10);
            return view('listings.index', compact('listings'))->with('isAdmin', true);
        } else {
            // Users see only their own listings and can modify them
            $listings = Listing::where('user_id', Auth::id())->paginate(10);
            return view('listings.index', compact('listings'))->with('isAdmin', false);
        }
    }

    // ✅ Show create form (only for users)
    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('listings.index')->with('error', 'Admins cannot create listings.');
        }
        return view('listings.create');
    }

    // ✅ Store listing data (only for users)
    public function store(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('listings.index')->with('error', 'Admins cannot create listings.');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $listing = new Listing($request->all());
        $listing->user_id = Auth::id(); // Assign ownership
        $listing->status = 'pending'; // Default status for admin approval
        $listing->save();

        return redirect()->route('listings.index')->with('success', 'Listing created successfully.');
    }

    // ✅ Admin can only view all listings, but users can manage their own
    public function manage()
    {
        $user = auth()->user();
        $isAdmin = $user->hasRole('admin'); // Check if the user is an admin

        if ($isAdmin) {
            return redirect()->route('listings.index')->with('error', 'Admins cannot manage listings.');
        }

        return view('listings.manage', [
            'listings' => $user->listings, // Get only the user's listings
            'isAdmin' => $isAdmin
        ]);
    }




    // ✅ Show single listing (everyone can view)
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // ✅ Show edit form (only for users)
    public function edit(Listing $listing)
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('listings.index')->with('error', 'Admins cannot edit listings.');
        }

        if ($listing->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('listings.edit', ['listing' => $listing]);
    }

    // ✅ Update listing (only for users)
    public function update(Request $request, Listing $listing)
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('listings.index')->with('error', 'Admins cannot modify listings.');
        }

        if ($listing->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $formField = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formField);
        return back()->with('message', 'Listing updated successfully!');
    }

    // ✅ Delete listing (only for users)
    public function destroy(Listing $listing)
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('listings.index')->with('error', 'Admins cannot delete listings.');
        }

        if ($listing->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }
}
