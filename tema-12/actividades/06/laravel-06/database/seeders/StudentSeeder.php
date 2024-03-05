<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert(
            [
                [
                    'name' => 'Pepe',
                    'last_name' => 'Perez',
                    'birth_date' => '1990-01-01',
                    'phone' => '666666666',
                    'city' => 'Ubrique',
                    'dni' => '11111111A',
                    'email' => 'JLX4p@example.com',
                    'course_id' => 1
                ],
                [
                    'name' => 'Joselito',
                    'last_name' => 'Jose',
                    'birth_date' => '1990-01-01',
                    'phone' => '777777777',
                    'city' => 'Ubrique',
                    'dni' => '22222222A',
                    'email' => 'JLX5p@example.com',
                    'course_id' => 1

                ],
                [
                    'name' => 'Manolito',
                    'last_name' => 'Manuel',
                    'birth_date' => '1990-01-01',
                    'phone' => '8888888888',
                    'city' => 'Ubrique',
                    'dni' => '33333333A',
                    'email' => 'JLX6p@example.com',
                    'course_id' => 1
                ],
                [
                    'name' => 'Carlitos',
                    'last_name' => 'Carlos',
                    'birth_date' => '1990-01-01',
                    'phone' => '999999999',
                    'city' => 'Ubrique',
                    'dni' => '44444444A',
                    'email' => 'JLX7p@example.com',
                    'course_id' => 1
                ]
            ]
        );
    }
}
