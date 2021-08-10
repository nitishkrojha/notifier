<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClientController extends Controller
{
    public function post(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|string|min:3|max:255',
        ]);

        $client = new Client;
        $client->name = $request->name;
        $client->save();

        return $client;
    }

    public function list(Request $request)
    {
        $request->validate([
            'page' => 'integer|min:1|max:10',
            'per_page' => 'integer|min:10|max:25',
        ]);

        return Client::paginate($request->per_page ?? 10);
    }
}
