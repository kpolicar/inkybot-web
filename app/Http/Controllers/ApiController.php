<?php

namespace App\Http\Controllers;

use App\Models\FreeTrial;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use LaravelLocalization;
use Validator;
use Image;
use Storage;
use OneSignal;
use Http;
use Str;
use App\ClientVersion;
use App\Http\Middleware\AuthenticateWithSignature;
use App\Http\Middleware\DecryptApiRequest;
use App\Http\Middleware\EncryptApiResponse;
use App\Http\Middleware\Subscribed;
use App\Http\Resources\ClientUser as ClientUserResource;
use App\Http\Resources\ClientUserV20 as ClientUserResourceV20;
use App\Models\Maging;
use Illuminate\Http\Request;
use App\Http\Resources\ClientFreeTrial as ClientFreeTrialResource;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->middleware(Subscribed::class)
            ->except(['Info', 'User', 'BeginTrial']);
        $this->middleware(EncryptApiResponse::class)
            ->except('Info', 'StatisticsView', 'StatisticsNewSession');
        $this->middleware(DecryptApiRequest::class)
            ->only('StatisticsUpdate');
        $this->middleware(AuthenticateWithSignature::class)
            ->only('StatisticsPublish');
    }

    public function Info($code, ClientVersion $versions) {
        $version = $versions->firstWhere('code', $code);

        return [
            'name' => $version['name'],
            'endpoint' => $version['code'],
            'number' => $version['number'],
        ];
    }

    public function BeginTrial(Request $request)
    {
        $freeTrial = FreeTrial::where('user_id', $user_id = $request->user()->id)
            ->orWhere('ip_address', $ip_address = $request->ip())
            ->updateOrCreate([], compact('user_id', 'ip_address'));

        return new ClientFreeTrialResource($freeTrial);
    }

    public function User($code, Request $request, ClientVersion $versions) {
        $version = $versions->firstWhere('code', $code);
        if ($version['number'] < 19) {
            return $this->UserForRequestBeforeV2($request);
        }
        if ($version['number'] >= 20) {
            return new ClientUserResourceV20($request->user());
        }
        return new ClientUserResource($request->user());
    }

    private function UserForRequestBeforeV2(Request $request)
    {
        $user = $request->user();
        if ($user->subscribed() && $user->number_of_exo_mages_left_in_plan <= 0) {
            $user->subscription()->ends_at = now()->subDay();
            $user->free_trial = $user->free_trial()->make()->forceFill([
                'expires_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'created_at' => now()->subDay(),
            ]);
            $user->free_trial->exists = true;
            return new ClientUserResource($user);
        }
        return new ClientUserResource($user);
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

    public function NotifyActionNeeded(Request $request) {
        $message = "The bot has been interrupted and requires user interaction!";
        $this->NotifyDiscord($request, $message);
        $this->NotifyOneSignal($request, $message);
    }

    public function NotifyFinished(Request $request) {
        $message = "Your item is complete!";
        $message .= $request->boolean('continueQueue', false)
            ? " The bot has begun maging the next item in the queue."
            : " The bot has finished maging.";
        $this->NotifyDiscord($request, $message);
        $this->NotifyOneSignal($request, $message);
    }

    public function StatisticsView($version, $errors=[])
    {
        $this->setLocaleFromInputParam();
        $errorBag = new ViewErrorBag;
        if ($errors)
            $errorBag->put('default', $errors);

        return view('api/statistics', compact('version') + ['errors' => $errorBag]);
    }

    public function StatisticsNewSession(Request $request, $version)
    {
        $this->setLocaleFromInputParam();
        $validator = Validator::make($request->all(), [
            'label' => 'nullable|string|max:50'
        ]);
        if ($validator->fails()) {
            return $this->StatisticsView($version, $validator->errors());
        }

        $current = Maging::activeForUser($request->user());
        if ($current->expended || $current->exo_attempts || $current->exo_successes || !$current->exists) {
            $request->user()->maging()->create(
                $request->only('label')
            );
        } else if ($current->exists) {
            if ($current->label != $request->input('label')) {
                $current->update($request->only('label'));
            } else {
                $errors = new MessageBag([
                    'default' => __('validation.session_in_progress')
                ]);
            }
        }
        return $this->StatisticsView($version, isset($errors) ? $errors : []);
    }

    protected function setLocaleFromInputParam()
    {
        app()->setLocale(
            request()->input('locale', $locale = LaravelLocalization::getDefaultLocale())
        );
    }

    public function StatisticsUpdate(Request $request) {
        $maging = Maging::activeForUser($request->user());
        if ($request->boolean('start_new_session')) {
            if ($maging->expended || $maging->exo_attempts || $maging->exo_successes || !$maging->exists) {
                $maging = $request->user()->maging()->create();
            }
        }
        $expended = $request->input('expend', 0);
        $timeMaging = $request->input('time_maging', 0);

        if ($expended > 300000 || !$request->input('expended_enabled', false))
            $expended = 0;
        if ($timeMaging > 300 * 1000)
            $timeMaging = 0;

        $maging->expended += max(0, $expended);
        $maging->time_maging += max(0, $timeMaging);

        foreach (json_decode($request->input('attempts', "{}"), true) as $stat => $runeTypeAttempts) {
            $magingAttempts = $maging->attempts ?? [];

            foreach ($runeTypeAttempts as $runeType => $attempts) {
                $magingAttempts[$stat][$runeType] = $attempts + ((int) data_get($magingAttempts, "$stat.$runeType", 0));
            }
            $maging->attempts = $magingAttempts;
        }
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

        $fileName = Str::random(40).'.jpg';
        $path = "public/mages/{$request->user()->id}";
        Storage::makeDirectory($path);
        $image->save(storage_path("app/$path/$fileName"), 75);

        $request->user()->publishes()->create([
            'image_path' => Storage::url("$path/$fileName"),
            'dont_publish_to_forum' => !$request->input('publish_to_forum', true)
        ]);
    }

    private function NotifyOneSignal(Request $request, $message)
    {
        try {
            if ($request->user()->optin_web_notifications) {
                \OneSignal::sendNotificationToExternalUser(
                    $message,
                    (string) $request->user()->id,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                );
            }
        } catch (\Throwable $t) {
        }
    }

    private function NotifyDiscord(Request $request, $message)
    {
        try {
            if ($request->user()->optin_discord_notifications && $request->user()->discord_id) {
                $content = "!notify {$request->user()->discord_id} \":bell: $message\"";
                \Http::post(
                    config('discord.webhook_url'),
                    compact('content')
                );
            }
        } catch (\Throwable $t) {
        }
    }
}
