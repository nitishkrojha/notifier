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
        Template::factory()->for($clientIFlex)->create();
        Template::factory()->for($clientIFlex)->create();

        $clientAtz = Client::factory()->create([
            'name' => 'Atz',
            'username' => 'atz',
            'password' => Hash::make('password'),
            'sms_provider_id' => Sms\Fast2SmsProvider::getId(),
        ]);
        Template::factory()->for($clientAtz)->create();
        Template::factory()->for($clientAtz)->create();
    }
}
