<?php

namespace Database\Factories;

use App\Models\Ads;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ads::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ads_title' => $this->faker->title(),
            'ads_price' => $this->faker->randomNumber(4),
            'ads_type' => 1,
            'ads_owner_name' => $this->faker->name(),
            'ads_owner_email' => $this->faker->unique()->safeEmail(),
            'ads_owner_phone' => $this->faker->phoneNumber(),
            'ads_address' => $this->faker->address(),
            'ads_image_url' => 'ads-example.gif',
            'ads_link' => $this->faker->url(),
            'is_active' => 1,
        ];
    }
}
