<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientUser extends JsonResource
{

    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'i30jfVx9krmacQH' => $this->name,
            'name' => $this->name,

            'CXpD6X71WZhYsHf' => $this->email,
            'email' => $this->email,

            'rbvQL1e41MOgDLA' => $this->subscribed_to,
            'subscribed_to' => $this->subscribed_to,

            'wVakGMaAnUQkCFZ' => $this->subscribed(),
            'is_subscribed' => $this->subscribed(),

            'Sw6mNjvR0HZofKj' => $this->is_free_trial,
            'is_free_trial' => $this->is_free_trial,

            'EbP8tMjESR6IGvi' => $this->free_trial_available,
            'free_trial_available' => $this->free_trial_available,

            'OfHJ5MXIHDpJiL8' => $this->trial_ends_at,
            'trial_ends_at' => $this->trial_ends_at,
        ];
    }
}
