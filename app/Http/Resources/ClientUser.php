<?php

namespace App\Http\Resources;

use App\Billing;
use Carbon\Carbon;
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
        try {
            $periodEndsAt = $this->subscription()->current_period_end;
            $subscribedTo = $periodEndsAt ? new Carbon($periodEndsAt) : now();
        } catch (\Exception $e) {
            $subscribedTo = now();
        }
        return [
            'i30jfVx9krmacQH' => $this->name,
            'CXpD6X71WZhYsHf' => $this->email,
            'rbvQL1e41MOgDLA' => $subscribedTo, //deprecated: subscribed_to
            'wVakGMaAnUQkCFZ' => $this->subscribed(),
            'Sw6mNjvR0HZofKj' => $this->is_free_trial,
            'EbP8tMjESR6IGvi' => $this->free_trial_available,
            'xXTPOXHgAlFoCHx' => optional($this->trial_ends_at)->format('H:i'),
            'GIZiGvqAkMRUyZc' => $this->can('custom-maging-ai'),
            'aloThuYtoJVqZYK' => $this->can('view-statistics'),
            'jINhXckEVJaciuq' => $this->can('mage-exos'),
            'bP6Aa9RdmDlggKY' => $this->subscribedToPlan(Billing::starterPlan()),
            'ls6uIocgdyUtp4c' => $this->subscribedToPlan(Billing::standardPlan()),
            'SniDbUjb49VghoM' => $this->subscribedToPlan(Billing::unlimitedPlan()),
        ];
    }
}
