<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Cristabel\Domain\Administrator;

class AdministratorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrator::create([
            'name' => 'Julie',
            'email' => 'julie@cristabel.com',
            'password' => bcrypt('@cristabel')
        ]);
    }
}
