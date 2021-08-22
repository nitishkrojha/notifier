<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Sms;
use App\Sms\Status;

class SmsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sms::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sms_provider_id' => Sms\MockProvider::getId(),
            'sms_provider_sender_id' => 'TXTIND',
            'status' => Status::PENDING,
            'num_attempts' => 0,
            'phone' => '9999999999',
            'text' => 'Hello world',
        ];
    }
}
