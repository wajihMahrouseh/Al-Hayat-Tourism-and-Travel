<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $driverRole = Role::firstOrCreate(['name' => 'driver', 'guard_name' => 'api']);

        // admins
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        $user->assignRole($adminRole);


        // drivers
        $user = User::create([
            'name' => 'driver-1',
            'username' => 'driver-1',
            'password' => Hash::make('driver-1'),
        ]);

        $driver = $user->driver()->create([
            'phone' => '123456789',
            'car_number' => '250-652',
            'car_color' => 'black',
        ]);

        $user->assignRole($driverRole);



        $user = User::create([
            'name' => 'driver-2',
            'username' => 'driver-2',
            'password' => Hash::make('driver-2'),
        ]);

        $driver = $user->driver()->create([
            'phone' => '123456789',
            'car_number' => '250-652',
            'car_color' => 'black',
        ]);


        $user->assignRole($driverRole);



        $user = User::create([
            'name' => 'driver-3',
            'username' => 'driver-3-3',
            'password' => Hash::make('driver-3'),
        ]);

        $driver = $user->driver()->create([
            'phone' => '123456789',
            'car_number' => '250-652',
            'car_color' => 'black',
        ]);


        $user->assignRole($driverRole);
    }
}
