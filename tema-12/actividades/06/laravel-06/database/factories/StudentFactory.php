<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Student;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition(): array
    {
        $courses = Course::all()->pluck('id')->toArray();

        return [
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birth_date' => fake()->date(),
            'phone' => fake()->unique()->e164PhoneNumber(),
            'city' => fake()->city(),
            'dni' => fake()->unique()->regexify('\d{8}[TRWAGMYFPDXBNJZSQVHLCKE]'),
            'email' => fake()->unique()->safeEmail(),
            'course_id' => fake()->randomElement($courses),
        ];
    }
}
