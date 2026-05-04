<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $authorRole = Role::create(['name' => 'author']);
        $memberRole = Role::create(['name' => 'member']);

        // Create permissions
         $createPosts = Permission::create(['name' => 'create posts']);
        $readPosts = Permission::create(['name' => 'read posts']);
        $editPosts = Permission::create(['name' => 'edit posts']);
        $deletePosts = Permission::create(['name' => 'delete posts']);



        // Create permissions for comments
         $createComments = Permission::create(['name' => 'create comments']);
        $readComments = Permission::create(['name' => 'read comments']);
        $editComments = Permission::create(['name' => 'edit comments']);
        $deleteComments = Permission::create(['name' => 'delete comments']);


        $allPermissions=Permission::all();
        $adminRole->givePermissionTo($allPermissions);
        $moderatorRole->givePermissionTo([$createPosts,$readPosts,$editPosts,$createComments,$editComments,$readComments,$deleteComments]);
        $authorRole->givePermissionTo([$createPosts,$readPosts,$createComments,$readComments]);
        $memberRole->givePermissionTo([$readPosts,$createComments,$readComments]);

        $admin=User::create([
            "username" => "daja",
            "last_name" => "Jacquel",
            "first_name" => "David",
            "email" => "david@mail.com",
            'password'          => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
        ]);

        $admin->assignRole($adminRole);


    }
}
