<?php

namespace App\Http\Resources;

use App\Billing;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

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
            'rGEFoEUizObjmwg' => $this->number_of_exo_mages_left_in_plan ?: 0,
            'CXpD6X71WZhYsHf' => $this->email,
            'rbvQL1e41MOgDLA' => optional($this->validSubscription())->current_period_end ?: $this->subscribed_to, //deprecated: subscribed_to
            'wVakGMaAnUQkCFZ' => $this->subscribed(),
            'Sw6mNjvR0HZofKj' => $this->is_free_trial,
            'EbP8tMjESR6IGvi' => $this->free_trial_available,
            'xXTPOXHgAlFoCHx' => optional($this->trial_ends_at)->format('H:i'),
            'GIZiGvqAkMRUyZc' => $this->can('custom-maging-ai'),
            'aloThuYtoJVqZYK' => $this->can('view-statistics'),
            'OfGoZPnBHQxneiN' => $this->can('create-statistics'),
            'BwgdubYTUtyRdER' => $this->can('publish-exos'),
            'jINhXckEVJaciuq' => $this->can('mage-exos'),
            'bP6Aa9RdmDlggKY' => $this->subscribedToPlan(Billing::starterPlan()),
            'ls6uIocgdyUtp4c' => $this->subscribedToPlan(Billing::standardPlan()),
            'SniDbUjb49VghoM' => $this->subscribedToPlan(Billing::unlimitedPlan()) || $this->subscribedToPlan(Billing::unlimitedWithQueuePlan()),
        ];
    }
}
