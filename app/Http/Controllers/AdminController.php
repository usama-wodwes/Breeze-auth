<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;

class AdminController extends Controller
{
    public function manageUsers()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function viewAllProducts()
    {
        $listings = Listing::paginate(10);
        return view('admin.products', compact('listings'));
    }

    public function approveProduct($id)
    {
        $this->authorize('approve product'); // Ensure only authorized users can approve

        $listing = Listing::findOrFail($id);
        $listing->status = 'approved';
        $listing->save();

        return redirect()->back()->with('success', 'Product approved successfully.');
    }
}
