<?php

namespace App;

use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository as PassportTokenRepository;

class TokenRepository extends PassportTokenRepository
{
    public function revokeAccessToken($id)
    {
        return Passport::token()->where('id', $id)->delete();
    }
}
