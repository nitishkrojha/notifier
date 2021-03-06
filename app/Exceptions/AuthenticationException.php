<?php

namespace App\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        // TODO
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        // TODO: Fix http response status code.
        return response()->json(['message' => $this->message]);
    }
}
