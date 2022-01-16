<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'آدمن';
        $role->save();

        $permissions = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17'];

        $role->permissions()->attach($permissions);
    }
}
