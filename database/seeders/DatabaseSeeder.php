<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Doctor;
use App\Models\medicine;
use App\Models\Department;
use App\Models\About;
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
      
      Role::create(['id'=> '1' , 'name'=>'admin']);
      Role::create(['id'=> '2', 'name'=>'doctor']);
      Role::create(['id'=> '3', 'name'=>'receptionist']);
      Role::create(['id'=> '4', 'name'=>'patient']);
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
        'user_fName' => 'Conchita',
        'user_lName' => 'Bergado',
        'role_id' => '2',
        'user_address' => 'Valencia City',
        'user_gender' => 'female',
        'user_phoneNum' => '090909',
        'user_department' => 'Family-Medicine',
        'email' => 'doctor1@email.com',
        'password' => bcrypt('password'),
        'user_birthdate' => $birthdate,
        'confirmed_at' => now()

      ]);
      User::create([
        'id' => '4',
        'user_fName' => 'Stephen',
        'user_lName' => 'Bergado',
        'role_id' => '2',
        'user_address' => 'Valencia City',
        'user_gender' => 'male',
        'user_phoneNum' => '09195235111',
        'user_department' => 'General Surgeon',
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
        'user_phoneNum' => '09195235111',
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
        'doctor_title' => 'M.D.',
        'doctor_department' => 'Family-Medicine',
        'description' => 'Fellow, Philippine Academy of Family Physician Practitioner, Newborn &amp; Childrens Diseases Practitioner, Occupational Medicine',
        'license' => '059296'
      ]);
      Doctor::create([
        'user_id' => '4',
        'doctor_title' => 'M.D.',
        'doctor_department' => 'General Surgeon',
        'description' => '<p style="text-align: center;">Surgery, Fractures and Traumatic Injuries Fellow, Philippine Academy of Family Physician Practioner, Occupational</p>',
        'license' => '056192'
      ]);

      Department::create([
        'dept_name' => 'Family-Medicine',
      ]);
      Department::create([
        'dept_name' => 'General Surgeon',
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
      About::create([
        'description' => '<h1 style="text-align: center; ">Mission &amp; Vision</h1><h1 style=""><div style="text-align: center;"><br></div><div style="text-align: center;"><span style="color: inherit; font-family: inherit; font-size: 2.25rem;">The UCC Way</span></div></h1><p style="text-align: center; "><br></p><h2 style="text-align: left;">THE URGENT CARE CLINIC VISION:</h2><h4 style="text-align: left;">&nbsp; &nbsp; &nbsp;The Urgent care Clinic is commited to be a leading provider of preventive health care services by delivering high quality outcomes for clients and ensuring long term patient friendly relationship. </h4><h4 style="text-align: left; margin-left: 25px;">- We are caring, progressive, enjoying our work and use positive spirit to succeed.&nbsp; &nbsp;</h4><h4 style="text-align: left; margin-left: 25px;">- We take pride in our achievements and actively seek new ways of doing things better.<span style="color: inherit; font-family: inherit; font-size: 0.9rem;">&nbsp;</span></h4><h4 style="text-align: left; margin-left: 25px;">- We value Integrity credibility and respect for the individual &amp; family.</h4><h4 style="text-align: left; margin-left: 25px;">- We built constructive relationships to achieve positive outcomes for all.</h4><h4 style="text-align: left; margin-left: 25px;">- We believe that success comes through recognizing and encouraging the value of people and &nbsp;&nbsp;&nbsp;&nbsp;teams.</h4><h4 style="text-align: left;">We aim to grow &amp; improve our medical services while closely maintaing our patient care</h4><h2 style="text-align: left;">THE URGENT CARE CLINIC MISSION:</h2><h4 style="margin-left: 25px;">- To participate in the creation of a healther lives within the community.</h4><h4 style="margin-left: 25px;">- To provide health care services in a responsible manner which contribute to the physical. psychological, social &amp; spirital well being of the patients&nbsp; &amp; community which it serves.</h4><h4 style="text-align: left; margin-left: 25px;">- To provide assistance to the whole person in a christian spirit of equality &amp; interfaith serving all regardless of age, color, creed or gender.&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bolder;"><br></span></h4>'
      ]);
    }
}
