<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function viewAllProducts()
    {
        $listings = Listing::paginate(10);
        return view('admin.products', compact('listings'));
    }

    public function approveProduct($id)
    {
        $this->authorize('approve product');  // Ensure only authorized users can approve

        $listing = Listing::findOrFail($id);
        $listing->status = 'approved';
        $listing->save();

        return redirect()->back()->with('success', 'Product approved successfully.');
    }

    public function update(Request $request)
    {
        Listing::find($request->id)->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Listing updated successfully.');
    }

    public function approve(Listing $listing)
    {
        $listing->status = 'approved';
        $listing->save();

        return redirect()->back()->with('success', 'Listing approved successfully.');
    }

    public function reject(Listing $listing)
    {
        $listing->status = 'rejected';
        $listing->save();

        return redirect()->back()->with('error', 'Listing rejected.');
    }
}
