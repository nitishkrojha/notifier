<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Client;
use App\Exceptions\AuthenticationException;

class AuthenticateClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $username = $request->getUser();
        $password = $request->getPassword();

        if (!$username || !$password) {
            throw new AuthenticationException('Please provide basic username and password');
        }

        $client = Client::where('username', $username)->first();
        if (!$client) {
            throw new AuthenticationException('Invalid basic username');
        }
        if (!Hash::check($password, $client->password)) {
            throw new AuthenticationException('Invalid basic password');
        }

        $request->setAuthenticatedClient($client);

        return $next($request);
    }
}
