<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Services\UserService;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
    
            $products->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhere('price', 'like', '%' . $searchTerm . '%');
            });
        }

        $products = $products->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'role' => ['nullable', 'in:ADMIN,STAFF,VENDOR']
        ]);

        DB::beginTransaction();
        try {
            $createdUser = UserService::create($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        if($createdUser['error']) {
            return back()->withErrors(['errors' => $createdUser['message']]);
        }

        return redirect('/products')->with(['success' => 'User has been created.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('products.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|in:ADMIN,STAFF,VENDOR',
        ]);

        $user = User::findOrFail($id); 

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // remove role by name
        $user->removeRole($user->roles->first()->name);
        $user->assignRole($request->input('role'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect('/products')->with('success', 'User updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/products')->with(['success' => 'User has been deleted.']);
    }
}
