<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('session.register');
    }

    public function registering(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'address' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted'],
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

        if($createdUser['error'] == false) {
            return redirect('/')->with(['success' => 'Your vendor account has been created, waiting for approval from admin.']);
        }

        return back()->withErrors(['errors' => $createdUser['message']]);
    }

    public function login()
    {
        if(Auth::check()) {
            return redirect('/dashboard');
        }
        return view('session.login');
    }

    public function signing(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);
        if(Auth::attempt($validatedData)) {
            if(Auth::user()->hasRole('VENDOR')) {
                $user = Auth::user();
                $vendorStatus = $user->vendor->status;
                if($vendorStatus == 'PENDING') {
                    Auth::logout();
                    return back()->with('error', 'Your account is still pending approval.');
                }
                if($vendorStatus == 'REJECTED') {
                    Auth::logout();
                    return back()->with('error', 'Your account has been rejected.');
                }
            }
            

            session()->regenerate();
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        } else{
            Auth::logout();
            return back()->with('error', 'Invalid credentials.');
        }
    }
    
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }


    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
    
            $users->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $users->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
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

        return redirect('/users')->with(['success' => 'User has been created.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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

        return redirect('/users')->with('success', 'User updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with(['success' => 'User has been deleted.']);
    }
}
