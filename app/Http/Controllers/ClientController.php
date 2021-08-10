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
}
