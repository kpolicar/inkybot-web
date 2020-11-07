<?php namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Http\Responses\LoginResponse as FortifyLoginResponse;

class LoginResponse extends FortifyLoginResponse
{

    public function toResponse($request)
    {
        $response = parent::toResponse($request);
        if ($response instanceof RedirectResponse)
            $response->with(['logged_in' => true]);

        return $response;
    }
}
