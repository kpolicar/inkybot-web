<?php

namespace App\Http\Controllers;

use App\ClientVersion;
use App\Http\Middleware\EncryptApiResponse;
use App\Http\Middleware\Subscribed;
use App\Http\Resources\ClientUser as ClientUserResource;
use App\Models\Maging;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->middleware(Subscribed::class)
            ->except(['Info', 'User']);
        $this->middleware(EncryptApiResponse::class)
            ->except('Info');
    }

    public function Info($code, ClientVersion $versions) {
        $version = $versions->firstWhere('code', $code);

        return [
            'name' => $version['name'],
            'endpoint' => $version['code'],
            'number' => $version['number'],
        ];
    }

    public function User(Request $request) {
        return new ClientUserResource($request->user());
    }

    public function NotifyError(Request $request) {
        $message = "An error has occurred during maging! The bot has stopped.";
        $this->NotifyDiscord($request, $message);
        $this->NotifyOneSignal($request, $message);
    }

    public function NotifyRunes(Request $request) {
        $message = "You have run out of runes (" . $request->input('rune') . "). The bot has stopped.";
        $this->NotifyDiscord($request, $message);
        $this->NotifyOneSignal($request, $message);
    }

    public function NotifyFinished(Request $request) {
        $message = "Your item is complete! The bot has finished maging.";
        $this->NotifyDiscord($request, $message);
        $this->NotifyOneSignal($request, $message);
    }

    public function StatisticsUpdate(Request $request) {
        $maging = Maging::todaysForUser($request->user());

        if (($expended = $request->input('expend', 0)) > 300000
            || !$request->input('expended_enabled', false))
            $expended = 0;
        $maging->expended += $expended;
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

    public function StatisticsPublish(Request $request) {
        $request->validate([
            'image'=> 'required|image|max:1000',
        ]);
        $image = Image::make($request->file('image'))->encode('jpg');
        $image->insert(asset('images/inkybot_watermark.png'), 'bottom-right');
        $image->insert(asset('images/smithmagus_parachment_watermark.png'), 'top-right', 8, 39);

        $fileName = Str::random(40).'.jpg';
        $path = "public/mages/{$request->user()->id}";
        Storage::makeDirectory($path);
        $image->save(storage_path("app/$path/$fileName"), 75);

        $request->user()->publishes()->create([
            'image_path' => Storage::url("$path/$fileName")
        ]);
    }

    private function NotifyOneSignal(Request $request, $message)
    {
        if ($request->user()->optin_web_notifications) {
            \OneSignal::sendNotificationToExternalUser(
                $message,
                $request->user()->id,
                $url = null,
                $data = null,
                $buttons = null,
                $schedule = null,
            );
        }
    }

    private function NotifyDiscord(Request $request, $message)
    {
        if ($request->user()->optin_discord_notifications) {
            $content = "!notify {$request->user()->discord_id} \":bell: $message\"";
            \Http::post(
                config('discord.webhook_url'),
                compact('content')
            );
        }
    }
}
