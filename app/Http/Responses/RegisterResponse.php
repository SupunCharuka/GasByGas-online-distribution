<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $redirect = redirect(config('fortify.' . authUserFolder()));
        if ($request->wantsJson()) {
            return response()->json(['sign_up' => true, 'redirect' => $redirect->getTargetUrl()]);
        }
        return $redirect;
    }
}
