<?php

use App\Employees;
use App\Listings;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employees::class, 10)->create();
    }
}
