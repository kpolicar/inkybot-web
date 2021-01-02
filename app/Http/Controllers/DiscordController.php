<?php

namespace App\Http\Controllers;

use App\Events\UserSyncedWithDiscord;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordController extends Controller
{
    public function Login(Request $request) {
        $request->validate([
            'email' => 'exists:users',
            'discord_id' => 'required',
        ]);
        $user = User::where('email', $request->input('email'))->first();
        $user->discord_id = $request->input('discord_id');
        $user->save();
    }
}
