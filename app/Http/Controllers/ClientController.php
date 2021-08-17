<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Sms\Sms;

class ClientController extends Controller
{
    public function post(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string|min:3|max:255',
            'sms_provider_id' => ['bail', 'required', 'integer', function ($attribute, $value, $fail) {
                if (!Sms::isValidProvider($value)) {
                    $fail('The sms provider id is invalid.');
                }
            }]
        ]);

        $client = new Client;
        $client->name = $request->name;
        $client->sms_provider_id = $request->sms_provider_id;
        $client->save();

        return $client;
    }

    public function list(Request $request)
    {
        $request->validate([
            'page' => 'bail|integer|min:1|max:10',
            'per_page' => 'bail|integer|min:10|max:25',
        ]);

        return Client::paginate($request->per_page ?? 10);
    }

    public function get(Request $request, string $id)
    {
        // Todo: Make api error response more human friendly.
        return Client::findOrFail($id);
    }

    public function patch(Request $request, string $id)
    {
        $request->validate([
            'name' => 'bail|string|min:3|max:255',
            'sms_provider_id' => ['bail', 'integer', function ($attribute, $value, $fail) {
                if (!Sms::isValidProvider($value)) {
                    $fail('The sms provider id is invalid.');
                }
            }]
        ]);

        $client = Client::findOrFail($id);

        if ($request->has('name')) {
            $client->name = $request->name;
        }
        if ($request->has('sms_provider_id')) {
            $client->sms_provider_id = $request->sms_provider_id;
        }
        $client->save();

        return $client;
    }

    public function delete(Request $request, string $id)
    {
        Client::findOrFail($id)->delete();
    }
}
