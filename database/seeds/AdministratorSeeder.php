<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\Admin\Administrator::class,3)->create([
            'password' => bcrypt('password'),
        ]);
    }
}
