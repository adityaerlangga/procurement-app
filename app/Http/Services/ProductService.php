<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public static function create($request)
    {           
        try {
            if(!empty($request->file('image'))) {
                $file = $request->file('image');
                $file_path = Storage::put('uploads', $file);
            } else {
                $file_path = null;
            }

            $product = new Product();
            $product->name = $request->name;
            $product->vendor_id = $request->vendor_id;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $file_path;
            
            $product->save();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
        return [
            'error' => false,
            'message' => 'Your account has been created.',
            'data' => [
                'product' => $product,
            ],
        ];
    }

    public static function update($request, $id)
    {
        try {
            $product = Product::find($id);
            if(!empty($request->file('image')) && $product->image) {
                $file = $request->file('image');
                $file_path = Storage::put('uploads', $file);
                Storage::delete($product->image);
            } else if (!empty($request->file('image')) && !$product->image) {
                $file = $request->file('image');
                $file_path = Storage::put('uploads', $file);
            } else {
                $file_path = null;
            }

            $product->name = $request->name;
            $product->vendor_id = $request->vendor_id;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $file_path ?? null;
            
            $product->save();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
        return [
            'error' => false,
            'message' => 'Your account has been updated.',
            'data' => [
                'product' => $product,
            ],
        ];
    }
}