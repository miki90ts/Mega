<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'first_name' => "Aleksandar",
                'last_name' => "Jovanović",
                'mobile' => "/",
                'phone' => "156",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Aleksandar",
                'last_name' => "Petrović",
                'mobile' => "/",
                'phone' => "121",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Aleksandar",
                'last_name' => "Popović",
                'mobile' => "064/640-1165",
                'phone' => "104",
                'gender' => "1",
                'job_position_id' => "2"
            ],
            [
                'first_name' => "Aleksandra",
                'last_name' => "Vukobratović",
                'mobile' => "064/814-4124",
                'phone' => "/",
                'gender' => "2",
                'job_position_id' => "8"
            ],
            [
                'first_name' => "Biserka",
                'last_name' => "Andrić",
                'mobile' => "064/640-1176",
                'phone' => "133",
                'gender' => "2",
                'job_position_id' => "6"
            ],
            [
                'first_name' => "Bojan",
                'last_name' => "Lekić",
                'mobile' => "/",
                'phone' => "120",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Veroljub",
                'last_name' => "Gajić",
                'mobile' => "064/640-1172",
                'phone' => "112",
                'gender' => "1",
                'job_position_id' => "5"
            ],
            [
                'first_name' => "Danica",
                'last_name' => "Klječanin",
                'mobile' => "064/814-4131",
                'phone' => "147",
                'gender' => "2",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Danijela",
                'last_name' => "Miljanović",
                'mobile' => "064/814-4151",
                'phone' => "153",
                'gender' => "2",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Dejan",
                'last_name' => "Mijatović",
                'mobile' => "064/640-1164",
                'phone' => "164",
                'gender' => "1",
                'job_position_id' => "2"
            ],
            [
                'first_name' => "Đorđe",
                'last_name' => "Vasković",
                'mobile' => "064/814-4134",
                'phone' => "117",
                'gender' => "1",
                'job_position_id' => "5"
            ],
            [
                'first_name' => "Lazar",
                'last_name' => "Ranđelović",
                'mobile' => "064/814-4150",
                'phone' => "117",
                'gender' => "1",
                'job_position_id' => "5"
            ],
            [
                'first_name' => "Ivan",
                'last_name' => "Pušić",
                'mobile' => "/",
                'phone' => "120",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Jelena",
                'last_name' => "Armuš",
                'mobile' => "/",
                'phone' => "120",
                'gender' => "2",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Jelena",
                'last_name' => "Samardžić",
                'mobile' => "064/814-4114",
                'phone' => "/",
                'gender' => "2",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Jelena",
                'last_name' => "Grujić",
                'mobile' => "064/814-4128",
                'phone' => "129",
                'gender' => "2",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Ljiljana",
                'last_name' => "(Cvijić) Stanojević",
                'mobile' => "064/640-1175",
                'phone' => "114",
                'gender' => "2",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Milica",
                'last_name' => "Buturović",
                'mobile' => "/",
                'phone' => "114",
                'gender' => "2",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Milan",
                'last_name' => "Pantović",
                'mobile' => "/",
                'phone' => "135",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Miloš",
                'last_name' => "Ljubenović",
                'mobile' => "064/814-4111",
                'phone' => "109",
                'gender' => "1",
                'job_position_id' => "8"
            ],
            [
                'first_name' => "Miloš",
                'last_name' => "Nikolić",
                'mobile' => "/",
                'phone' => "135",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Milan",
                'last_name' => "Čučković",
                'mobile' => "/",
                'phone' => "135",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Marija",
                'last_name' => "Španović",
                'mobile' => "/",
                'phone' => "120",
                'gender' => "2",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Mirjana",
                'last_name' => "Čvarković",
                'mobile' => "064/640-1177",
                'phone' => "108",
                'gender' => "2",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Miloš",
                'last_name' => "Selaković",
                'mobile' => "/",
                'phone' => "108",
                'gender' => "1",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Mirjana",
                'last_name' => "Knežević",
                'mobile' => "064/640-1179",
                'phone' => "134",
                'gender' => "2",
                'job_position_id' => "6"
            ],
            [
                'first_name' => "Mirjana",
                'last_name' => "Cvijić",
                'mobile' => "064/814-4104",
                'phone' => "135",
                'gender' => "2",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Nataša",
                'last_name' => "Dmitrović",
                'mobile' => "064/814-4139",
                'phone' => "149",
                'gender' => "2",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Nemanja",
                'last_name' => "Savić",
                'mobile' => "/",
                'phone' => "121",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Nikola",
                'last_name' => "Živković",
                'mobile' => "/",
                'phone' => "135",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Slobodan",
                'last_name' => "Stjepanović",
                'mobile' => "064/814-4138",
                'phone' => "120",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Snežana",
                'last_name' => "Bogdanov",
                'mobile' => "064/640-1167",
                'phone' => "150",
                'gender' => "2",
                'job_position_id' => "1"
            ],
            [
                'first_name' => "Stevica",
                'last_name' => "Blagojević",
                'mobile' => "064/640-4374",
                'phone' => "109",
                'gender' => "1",
                'job_position_id' => "8"
            ],
            [
                'first_name' => "Tamara",
                'last_name' => "Mijatović",
                'mobile' => "064/640-1168",
                'phone' => "142",
                'gender' => "2",
                'job_position_id' => "1"
            ],
            [
                'first_name' => "Tamara",
                'last_name' => "Stepanov",
                'mobile' => "064/814-4121",
                'phone' => "127",
                'gender' => "2",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Miroslav",
                'last_name' => "Pavlović",
                'mobile' => "064/814-4130",
                'phone' => "124",
                'gender' => "1",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Filip",
                'last_name' => "Ginder",
                'mobile' => "/",
                'phone' => "119",
                'gender' => "1",
                'job_position_id' => "3"
            ],
            [
                'first_name' => "Veljko",
                'last_name' => "Krivokapić",
                'mobile' => "/",
                'phone' => "128",
                'gender' => "1",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Dragan",
                'last_name' => "Radičević",
                'mobile' => "/",
                'phone' => "124",
                'gender' => "1",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Dragan",
                'last_name' => "Malidža",
                'mobile' => "/",
                'phone' => "147",
                'gender' => "1",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Milan",
                'last_name' => "Grujić",
                'mobile' => "/",
                'phone' => "153",
                'gender' => "1",
                'job_position_id' => "4"
            ],
            [
                'first_name' => "Nenad",
                'last_name' => "Lazić",
                'mobile' => "/",
                'phone' => "120",
                'gender' => "1",
                'job_position_id' => "3"
            ]
            // Add more user data entries here
        ];

        foreach ($userData as $data) {
            $user = User::factory()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' =>  Hash::make('password'),
            ]);

            $user->profile()->create([
                'mobile' => $data['mobile'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'job_position_id' => $data['job_position_id'],
                'country_id' => 162,
                'birthday' => fake()->date(),
            ]);
        }
    }
}
