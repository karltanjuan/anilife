<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Inquiry;

class InquiryFactory extends Factory
{

    protected $model = Inquiry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name'     => $this->faker->name(),
            'email_address' => $this->faker->unique()->safeEmail(),
            'contact_no'    => $this->faker->numerify('09#########'),
            'message'       => $this->faker->text()
        ];
    }

    // Open tinker: Inquiry::factory()->count(10)->create()
}
