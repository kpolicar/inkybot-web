<?php

namespace App\Http\Controllers;

use App\ClientVersion;
use App\Http\Resources\ClientUser as ClientUserResource;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Info(ClientVersion $versions) {
        $last = $versions->latest();

        return [
            'name' => $last['name'],
            'endpoint' => $last['code'],
            'number' => $last['number'],
        ];
    }

    public function User(Request $request) {
        return new ClientUserResource($request->user());
    }
}
