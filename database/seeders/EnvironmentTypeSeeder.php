<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application\EnvironmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnvironmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $environmentTypes = [
            'Razvoj',
            'Produkcija',
        ];

        foreach ($environmentTypes as $type) {
            EnvironmentType::create([
                'name' => $type,
            ]);
        }
    }
}
