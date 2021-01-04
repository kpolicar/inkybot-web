<?php

namespace App\Http\Controllers;

use App\Models\Maging;
use App\Models\User;
use Illuminate\Http\Request;

class ClientStatisticsController extends Controller
{
    public function Update(Request $request) {
        $maging = Maging::todaysForUser($request->user());

        //$maging->expended += $request->input('expend', 0);
        foreach (json_decode($request->input('attempts_exo', "{}"), true) as $stat => $attempts) {
            $exoAttempts = $maging->exo_attempts ?? [];
            $exoAttempts[$stat] = $attempts + ($exoAttempts[$stat] ?? 0);
            $maging->exo_attempts = $exoAttempts;
        }
        foreach (json_decode($request->input('successes_exo', "{}"), true) as $stat => $attempts) {
            $exoSuccesses = $maging->exo_successes ?? [];
            $exoSuccesses[$stat] = $attempts + ($exoSuccesses[$stat] ?? 0);
            $maging->exo_successes = $exoSuccesses;
        }

        $maging->save();
    }
}
