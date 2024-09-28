<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Services\UserService;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        $users->role('VENDOR');

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
    
            $users->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $users->get();

        return view('vendors.index', compact('users'));
    }

    public function approve($id)
    {
        $vendor = Vendor::find($id);

        if ($vendor) {
            $vendor->status = 'APPROVED';
            $vendor->save();
        }

        return redirect()->back()->with(['success' => 'Vendor has been approved.']);
    }

    public function reject($id)
    {
        $vendor = Vendor::find($id);

        if ($vendor) {
            $vendor->status = 'REJECTED';
            $vendor->save();
        }

        return redirect()->back()->with(['success' => 'Vendor has been rejected.']);
    }
}
