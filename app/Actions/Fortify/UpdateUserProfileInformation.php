<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Fortify\Rules\Password;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $input['optin_discord_notifications'] =
            array_key_exists('optin_discord_notifications', $input) && $input['optin_discord_notifications'];
        $input['optin_web_notifications'] =
            array_key_exists('optin_web_notifications', $input) && $input['optin_web_notifications'];

        $this->validate($user, $input);

        $emailMustBeVerified = $input['email'] !== $user->email &&  $user instanceof MustVerifyEmail;
        if ($emailMustBeVerified)
            $user->email_verified_at = null;

        if ($input['password']) {
            $user->password = Hash::make($input['password']);
        }

        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'optin_discord_notifications' => $input['optin_discord_notifications'],
            'optin_web_notifications' => $input['optin_web_notifications'],
        ]);

        $user->save();

        if ($emailMustBeVerified)
            $user->sendEmailVerificationNotification();
    }

    public function validate($user, $input) {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', new Password],
            'current_password' => ['required_with:password', 'nullable', 'string'],
            'optin_web_notifications' => 'boolean',
            'optin_discord_notifications' => 'boolean',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->after(function ($validator) use ($user, $input) {
            if (!$input['password']) return;

            if (! Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updateProfileInformation');
    }
}

