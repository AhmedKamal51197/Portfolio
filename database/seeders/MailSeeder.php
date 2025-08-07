<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\Mail::create([
           'client_name' => 'اسم العميل',
           'client_email'=>'client@gmail.com',     
            'client_phone' => '+201034567890',
            'client_country' => 'مصر',

        ]);
        \App\Models\Mail::create([
            'client_name' => 'اسم العميل',
            'client_email'=>'client@gmail.com',     
             'client_phone' => '+201034567890',
             'client_country' => 'مصر',
 
        ]);
        \App\Models\Mail::create([
            'client_name' => 'اسم العميل',
            'client_email'=>'client@gmail.com',     
             'client_phone' => '+201034567890',
             'client_country' => 'مصر',
 
        ]);
        \App\Models\Mail::create([
            'client_name' => 'اسم العميل',
            'client_email'=>'client@gmail.com',     
             'client_phone' => '+201034567890',
             'client_country' => 'مصر',
 
        ]);
    }
}
