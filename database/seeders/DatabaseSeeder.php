<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Doctor;
use App\Models\medicine;
use App\Models\Department;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
  
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $birthdate = "2000-10-25";
      
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
          'confirmed_at' => now()
          
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
        'user_birthdate' => $birthdate,
        'confirmed_at' => now()
        
      ]);
      User::create([
        'id' => '3',
        'user_fName' => 'Johnes',
        'user_lName' => 'Butlay',
        'role_id' => '2',
        'user_address' => 'Valencia City',
        'user_gender' => 'male',
        'user_phoneNum' => '090909',
        'user_department' => 'General Surgeon',
        'email' => 'doctor1@email.com',
        'password' => bcrypt('password'),
        'user_birthdate' => $birthdate,
        'confirmed_at' => now()

      ]);
      User::create([
        'id' => '4',
        'user_fName' => 'Krisha',
        'user_lName' => 'Balaba',
        'role_id' => '2',
        'user_address' => 'Valencia City',
        'user_gender' => 'female',
        'user_phoneNum' => '09464646',
        'user_department' => 'Family-Medicine',
        'email' => 'doctor2@email.com',
        'password' => bcrypt('password'),
        'user_birthdate' => $birthdate,
        'confirmed_at' => now()

      ]);
      User::create([
        'id' => '5',
        'user_fName' => 'Rocky',
        'user_lName' => 'Boy',
        'role_id' => '4',
        'user_address' => 'Valencia City',
        'user_gender' => 'male',
        'user_phoneNum' => '0999999',
        'email' => 'user2@email.com',
        'password' => bcrypt('password'),
        'user_birthdate' => $birthdate,
        'confirmed_at' => now()
    ]);
    User::create([
      'id' => '6',
      'user_fName' => 'Staff',
      'user_lName' => 'staff',
      'role_id' => '3',
      'user_address' => 'Valencia City',
      'user_gender' => 'male',
      'user_phoneNum' => '0999999',
      'email' => 'staff1@email.com',
      'password' => bcrypt('password'),
      'user_birthdate' => $birthdate,
      'confirmed_at' => now()
  ]);
      Doctor::create([
        'user_id' => '3',
        'doctor_title' => 'MD',
        'doctor_department' => 'General Surgeon',
      ]);
      Doctor::create([
        'user_id' => '4',
        'doctor_title' => 'MD',
        'doctor_department' => 'Family-Medicine',
      ]);

      Department::create([
        'dept_name' => 'Family-Medicine',
      ]);
      Department::create([
        'dept_name' => 'General Surgery',
      ]);
      Department::create([
        'dept_name' => 'Therapist',
      ]);
      Department::create([
        'dept_name' => 'Dentist',
      ]);
      Department::create([
        'dept_name' => 'Neurologists',
      ]);
      Department::create([
        'dept_name' => 'Oncologist',
      ]); 

      medicine::create([
        'medicine_name' => 'XYPEN(CIPROFLOXACIN)',
        'medicine_dosage' => '500mg',
        'medicine_type' => 'Capsule'
      ]);
      medicine::create([
        'medicine_name' => 'OCCIB(CELECOXIB)',
        'medicine_dosage' => '200mg',
        'medicine_type' => 'Capsule'
      ]);
      medicine::create([
        'medicine_name' => 'OCCIB(CELECOXIB)',
        'medicine_dosage' => '400mg',
        'medicine_type' => 'Capsule'
      ]);
      medicine::create([
        'medicine_name' => 'RITEMED(AMOXICILLIN)',
        'medicine_dosage' => '500mg',
        'medicine_type' => 'Capsule'
      ]);
      medicine::create([
        'medicine_name' => 'LITTMOX(AMOXICILLIN TRIHYDRATE)',
        'medicine_dosage' => '500mg',
        'medicine_type' => 'Capsule'
      ]);
      medicine::create([
        'medicine_name' => 'MOXYLOR(AMOXICILLIN)',
        'medicine_dosage' => '250mg / 5mL',
        'medicine_type' => 'Liquid'
      ]);
      medicine::create([
        'medicine_name' => 'BIOGESIC(PARACETAMOL)',
        'medicine_dosage' => '100mg',
        'medicine_type' => 'Liquid'
      ]);
      medicine::create([
        'medicine_name' => 'FEVERGAN(PARACETAMOL)',
        'medicine_dosage' => '250mg / 5mL',
        'medicine_type' => 'Liquid'
      ]);
    }
}
