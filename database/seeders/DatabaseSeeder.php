<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Role::create(['name'=>'admin']);
      Role::create(['name'=>'doctor']);
      Role::create(['name'=>'receptionist']);
      Role::create(['name'=>'patient']);
        // \App\Models\User::factory(10)->create();
      
        User::create([
          'fName' => 'User1',
          'lName' => 'User1',
          'role_id' => '4',
          'address' => 'Valencia City',
          'gender' => 'male',
          'phoneNum' => '0999999',
          'email' => 'user1@email.com',
          'password' => bcrypt('password'),
      ]);
      User::create([
        'fName' => 'Ervin',
        'lName' => 'Butlay',
        'role_id' => '4',
        'address' => 'Valencia City',
        'gender' => 'male',
        'phoneNum' => '090909',
        'email' => 'user2@email.com',
        'password' => bcrypt('password'),
      ]);
      User::create([
        'fName' => 'Johnes',
        'lName' => 'Butlay',
        'role_id' => '2',
        'address' => 'Valencia City',
        'gender' => 'male',
        'phoneNum' => '090909',
        'email' => 'doctor1@email.com',
        'password' => bcrypt('password'),
      ]);
      User::create([
        'fName' => 'Krisha',
        'lName' => 'Balaba',
        'role_id' => '2',
        'address' => 'Valencia City',
        'gender' => 'female',
        'phoneNum' => '09464646',
        'email' => 'doctor2@email.com',
        'password' => bcrypt('password'),
      ]);
      User::create([
        'fName' => 'admin',
        'lName' => 'admin',
        'role_id' => '1',
        'address' => '0',
        'gender' => 'male',
        'phoneNum' => '0',
        'email' => 'admin@email.com',
        'password' => bcrypt('admin'),
      ]);
    }
}
