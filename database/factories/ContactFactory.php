<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $phone1 = $this->faker->phoneNumber();
        $phone2 = $this->faker->phoneNumber();
        $phone3 = $this->faker->phoneNumber();
        return [
            "name" => $this->faker->name(),
            "phones" =>  [$phone1, $phone2, $phone3],
            "user_id" => User::inRandomOrder()->first()->id,
        ];
    }
}
