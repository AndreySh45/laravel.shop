<?php

namespace Database\Seeders;

use App\Models\DeskList;
use Illuminate\Database\Seeder;

class DeskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeskList::factory(20)->create();
    }
}
