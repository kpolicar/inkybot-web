<?php

namespace App;

use Laravel\Passport\Passport;
use Laravel\Passport\RefreshTokenRepository as PassportRefreshTokenRepository;

class RefreshTokenRepository extends PassportRefreshTokenRepository
{
    public function revokeRefreshToken($id)
    {
        return Passport::refreshToken()->where('id', $id)->delete();
    }

    public function revokeRefreshTokensByAccessTokenId($tokenId)
    {
        Passport::refreshToken()->where('access_token_id', $tokenId)->delete();
    }
}
