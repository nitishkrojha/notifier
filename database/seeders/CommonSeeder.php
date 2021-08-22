<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Client;
use App\Models\Template;
use App\Sms;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientIFlex = Client::factory()->create([
            'name' => 'Iflex',
            'username' => 'iflex',
            'password' => Hash::make('password'),
            'sms_provider_id' => Sms\MockProvider::getId(),
        ]);
        $clientAtz = Client::factory()->create([
            'name' => 'Atz',
            'username' => 'atz',
            'password' => Hash::make('password'),
            'sms_provider_id' => Sms\Fast2SmsProvider::getId(),
        ]);

        Template::factory()->for($clientIFlex)->create(['text' => 'Hello world']);
        Template::factory()->for($clientIFlex)->create(['text' => 'Hello {name}! Your otp is for the transaction is {otp}.']);
        Template::factory()->for($clientAtz)->create(['text' => 'Hello world']);
        Template::factory()->for($clientAtz)->create(['text' => 'Hello {name}! Your otp is for the transaction is {otp}.']);
    }
}
