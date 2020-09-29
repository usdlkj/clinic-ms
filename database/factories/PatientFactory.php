<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'registration_number' => $this->faker->randomLetter,
            'name' => $this->faker->name,
            'birth_date' => $this->faker->dateTime,
            'age' => $this->faker->numberBetween(0,80),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}