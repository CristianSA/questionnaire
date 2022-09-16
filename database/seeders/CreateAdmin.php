<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;
use Hash;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Cristian',
            'nickname' => 'Cris',
            'email' => 'administrador@testing.com',
            'password' => Hash::make('admin12345'),
            'status' => true,
        ]);
    }
}
