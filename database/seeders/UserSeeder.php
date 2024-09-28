<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'ADMIN']);
        Role::create(['name' => 'STAFF']);
        Role::create(['name' => 'VENDOR']);

        $user = User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        $user->assignRole('ADMIN');

        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 15; $i++) {
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('vendor'),
            ]);
            $user->assignRole('VENDOR');

            $vendor = Vendor::create([
                'user_id' => $user->id,
                'name' => $name,
                'address' => $faker->address,
                'email' => $email,
                'status' => 'PENDING',
            ]);
        }
        for ($i = 1; $i <= 15; $i++) {
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('staff'),
            ]);
            $user->assignRole('STAFF');
        }
    }
}
