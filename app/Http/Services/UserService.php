<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Vendor;

class UserService
{
    public static function create(array $user)
    {   
        $user['password'] = bcrypt($user['password']);
        
        try {
            $createdUser = User::create($user);
            if(!empty($user['role'])) {
                $createdUser->assignRole($user['role']);
                $status = $user['role'] == 'VENDOR' ? 'APPROVED' : '';
            } else {
                $createdUser->assignRole('VENDOR');
                $status = 'PENDING';
            }
            $vendor = Vendor::create([
                'user_id' => $createdUser->id,
                'name' => $user['name'],
                'address' => empty($user['address']) ? '' : $user['address'],
                'email' => $user['email'],
                'status' => $status,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
        return [
            'error' => false,
            'message' => 'Your account has been created.',
            'data' => [
                'user' => $createdUser,
                'vendor' => $vendor
            ],
        ];
    }
}