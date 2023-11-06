<?php

namespace Database\Seeders;

use App\Models\Application\DatabaseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $databaseTypes = [
            'SQL Server',
            'MySQL',
            'Postgresql',

        ];

        foreach ($databaseTypes as $type) {
            DatabaseType::create([
                'name' => $type,
            ]);
        }
    }
}
