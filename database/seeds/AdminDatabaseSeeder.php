<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'Tarazy';
        $admin->email = 'tarazy@gmail.com';
        $admin->password = bcrypt('12345');
        $admin->role_id = 1;
        $admin->remember_token = true;
        $admin->save();
    }
}
