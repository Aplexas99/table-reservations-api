<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [];

        for ($i = 81; $i <= 120; $i++) {
            $tables[] = [
                'label' => (string)$i,
                'zone' => 'Red zone',
                'x' => 0,
                'y' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tables')->insert($tables);
    }
}
