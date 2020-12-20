<?php

namespace App\Http\Controllers;

use App\Models\Maging;
use Illuminate\Http\Request;

class ClientStatisticsController extends Controller
{
    public function Update(Request $request) {
        if ($expended = $request->input('expend')) {
            $this->UpdateExpended($request->user(), $expended);
        }
    }

    private function UpdateExpended($user, $amount) {
        $maging = Maging::todaysForUser($user);
        $maging->expended += $amount;
        $maging->save();
    }
}
