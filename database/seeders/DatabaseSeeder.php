<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Doctor;

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
          'id' => '1',
          'user_fName' => 'admin',
          'user_lName' => 'admin',
          'role_id' => '1',
          'user_address' => '0',
          'user_gender' => 'male',
          'user_phoneNum' => '0',
          'email' => 'admin@email.com',
          'password' => bcrypt('admin'),
        ]);

      User::create([
        'id' => '2',
        'user_fName' => 'Ervin',
        'user_lName' => 'Butlay',
        'role_id' => '4',
        'user_address' => 'Valencia City',
        'user_gender' => 'male',
        'user_phoneNum' => '090909',
        'email' => 'user1@email.com',
        'password' => bcrypt('password'),
      ]);
      User::create([
        'id' => '3',
        'user_fName' => 'Johnes',
        'user_lName' => 'Butlay',
        'role_id' => '2',
        'user_address' => 'Valencia City',
        'user_gender' => 'male',
        'user_phoneNum' => '090909',
        'email' => 'doctor1@email.com',
        'password' => bcrypt('password'),
      ]);
      User::create([
        'id' => '4',
        'user_fName' => 'Krisha',
        'user_lName' => 'Balaba',
        'role_id' => '2',
        'user_address' => 'Valencia City',
        'user_gender' => 'female',
        'user_phoneNum' => '09464646',
        'email' => 'doctor2@email.com',
        'password' => bcrypt('password'),
      ]);
      User::create([
        'id' => '5',
        'user_fName' => 'User1',
        'user_lName' => 'Users',
        'role_id' => '4',
        'user_address' => 'Valencia City',
        'user_gender' => 'male',
        'user_phoneNum' => '0999999',
        'email' => 'user2@email.com',
        'password' => bcrypt('password'),
    ]);
      Doctor::create([
        'user_id' => '3'
      ]);
      Doctor::create([
        'user_id' => '4'
      ]);
    }
}
