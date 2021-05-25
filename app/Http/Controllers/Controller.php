<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function activity(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);
        $magings = $request->user()->maging()->whereDate('created_at', $request->query('date'))->latest()->get();

        $content = $magings->reduce(function ($previousContent, $maging) {
            return $previousContent . view('partials/statistics', ['maging' => $maging, 'chart' => true]);
        });

        return $content ?: view('partials/statistics_none');
    }
}
