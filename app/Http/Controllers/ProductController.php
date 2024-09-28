<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\ProductService;

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
        $vendors = User::role('VENDOR')->get();

        return view('products.create', compact('vendors'));
    }

    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'name' => ['required', 'max:50'],
            'vendor_id' => ['required', 'exists:users,id'],
            'description' => ['max:255'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        DB::beginTransaction();
        try {
            $createdProduct = ProductService::create($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['errors' => $e->getMessage()]);
        }

        if($createdProduct['error']) {
            return back()->withErrors(['errors' => $createdProduct['message']]);
        }

        return redirect('/products')->with(['success' => 'Product has been created.']);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'vendor_id' => ['required', 'exists:users,id'],
            'description' => ['max:255'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $product = ProductService::update($request, $id);
        if($product['error']) {
            return back()->withErrors(['errors' => $product['message']]);
        }

        return redirect('/products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with(['success' => 'Product has been deleted.']);
    }
}
