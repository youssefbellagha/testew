<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\client;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

$permission = new Permission();
$permission->name = 'admin';
$permission->save();
$permission1 = new Permission();
$permission1->name = 'client';
$permission1->save();
$permission2 = new Permission();
$permission2->name = 'livreur';
$permission2->save();

$permission3 = new Permission();
$permission3->name = 'printer';
$permission3->save();

$permission4 = new Permission();
$permission4->name = 'famous';
$permission4->save();

$permission5 = new Permission();
$permission5->name = 'salon owner';
$permission5->save();



    $user =  \App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.fr',
            'password' => bcrypt('admin'),
            
        ]);

    $user->givePermissionTo($permission );


    $user1 =  \App\User::create([
            'name' => 'levreson',
            'email' => 'client@admin.fr',
            'password' => bcrypt('admin'),
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
    $user1->givePermissionTo($permission2 );


    $user2 =  client::create([
            'name' => 'printer',
            
        ]);
    $user2->givePermissionTo($permission3);

    }
}
