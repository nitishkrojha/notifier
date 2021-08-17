<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sms\Sms;

class SmsProviderController extends Controller
{
    public function list(Request $request)
    {
        $resp = [];

        foreach (Sms::$availableProviders as $provider) {
            $resp[] = [
                'id' => $provider::getId(),
                'name' => $provider::getName(),
            ];
        }

        return response()->json($resp);
    }
}
