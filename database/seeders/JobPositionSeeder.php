<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $job_positions = [
            'Prodaja',
            'Direktor',
            'Programer',
            'Implementacija',
            'Servis',
            'Sekretarica',
            'Vođa tima',
            'Održavanje',
        ];

        foreach ($job_positions as $position) {
            JobPosition::create([
                'title' => $position,
            ]);
        }
    }
}
