<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        $adminUser = User::create([
            'name' => 'Admin User', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin@123')
        ]);

        $adminRole = Role::create(['name' => 'Admin']);
        
        $adminPermissions = Permission::pluck('id','id')->all();
       
        $adminRole->syncPermissions($adminPermissions);
         
        $adminUser->assignRole([$adminRole->id]);
        
        // Seller User
        $sellerUser = User::create([
            'name' => 'Seller User', 
            'email' => 'seller@gmail.com',
            'password' => bcrypt('Seller@123')
        ]);

        $sellerRole = Role::create(['name' => 'Seller']);
         
        $sellerPermissions = Permission::whereIn('name', [
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ])->pluck('id','id')->all();

        $sellerRole->syncPermissions($sellerPermissions);
         
        $sellerUser->assignRole([$sellerRole->id]);

        $userRole = Role::create(['name' => 'User']);

        $sellerUser = User::create([
            'name' => 'User', 
            'email' => 'user@gmail.com',
            'password' => bcrypt('User@123')
        ]);

        $sellerUser->assignRole([$userRole->id]);

    }
}
