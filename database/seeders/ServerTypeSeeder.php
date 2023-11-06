<?php

namespace Database\Seeders;

use App\Models\Application\ServerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serverTypes = [
            'Razvoj',
            'Produkcija',

        ];

        foreach ($serverTypes as $type) {
            ServerType::create([
                'name' => $type,
            ]);
        }
    }
}
