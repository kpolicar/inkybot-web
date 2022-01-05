<?php

namespace App\Http\Controllers;

use App\ClientVersion;
use App\Exports\MagingExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AppController extends Controller
{
    public function home()
    {
        $gameVersion = Cache::get('game_version', function () {
            $response = rescue(function () {
                return Http::get('https://launcher.cdn.ankama.com/cytrus.json')->json();
            }, []);

            $gameVersion = Str::after(
                data_get($response, 'games.dofus.platforms.windows.main', config('app.latest_dofus_version')),
                '_');

            Cache::put('game_version', $gameVersion, now()->addDay());
            return $gameVersion;
        });

        return view('welcome', compact('gameVersion'));
    }

    public function download(ClientVersion $version)
    {
        $currentVersion = $version->latest();
        return redirect(asset("storage/Inkybot_{$currentVersion['code']}patch4.zip"));
    }

    public function profile(Request $request)
    {
        $message = $request->getSession()->get('notification');
        $action = "";
        if (!$message) {
            if (!optional($request->user())->hasVerifiedEmail()) {
                $message = __('forms.quick_verify_header');
                $action = 'partials.resend-verification';
            } elseif ($request->get('verified')) {
                $message = __('forms.quick_verify_success');
            }
        }
        $request->user()->loadMissing(['publishes' => function ($query) {
            $query->orderByDesc('created_at');
        }]);

        return view('profile')
            ->with(compact('message', 'action'));
    }

    public function subscribe(Request $request)
    {
        if (!$request->user()->can('purchase-subscription')) {
            return redirect(route('subscribe-manage'));
        } else {
            return view('subscribe');
        }
    }

    public function subscriptionManage(Request $request)
    {
        if (!$request->user()->cashierSubscribed())
            abort(403);
        return $request->user()->redirectToBillingPortal(url()->previous());
    }

    public function releaseNotes(ClientVersion $versions, $version)
    {
        $versionDetails = $version == "latest" ?
            $versions->latest() :
            $versions->firstWhere('code', $version);
        $view = $versionDetails['number'] ?? abort(404);
        return view("release.$view", ['version' => $versionDetails]);
    }

    public function usage(...$args)
    {
        return redirect()->to(route('release', $args).'#usage', 307);
    }

    public function export(Request $request)
    {
        return new MagingExport($request->user());
    }

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
