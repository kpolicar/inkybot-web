<?php

namespace App\Http\Resources;

use App\Billing;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class ClientUserV20 extends JsonResource
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
            'RTPbmvpAWeIUXnsnPdcm' => $this->name,
            'HMsEyaQcEUMkgnCBhgvX' => $this->number_of_exo_mages_left_in_plan ?: 0,
            'gMUnPVsYkgMgZqkulaQJ' => $this->email,
            'xXEgoygDzogjOgiNIxJH' => $this->subscribed(),
            'gNdQBAzXtFIXjCfjNPIK' => $this->is_free_trial,
            'dSkngxkoTRycwTHwkRWq' => $this->free_trial_available,
            'zSinZTfatTfVLaFljOqC' => optional($this->trial_ends_at)->format('H:i'),
            'tNzptPqDMerMLogKzJfk' => $this->can('custom-maging-ai'),
            'JVaYDkExoaVfqEqSWlwA' => $this->can('view-statistics'),
            'tnsVaYvUYfUyMoUCLcSk' => $this->can('create-statistics'),
            'ItfTLInEaoqhyTIMXclm' => $this->can('publish-exos'),
            'sLQXvDUEEttotgvaSwTj' => $this->can('mage-exos'),
            'JKrhIgzULnxEiszhYvam' => $this->subscribedToPlan(Billing::starterPlan()),
            'xrxqfXZtzcPHQMrccSSd' => $this->subscribedToPlan(Billing::standardPlan()),
            'MgtwORXnPLSWksFIVdJg' => $this->subscribedToPlan(Billing::unlimitedPlan()) || $this->subscribedToPlan(Billing::unlimitedWithQueuePlan()),
            'QMESAtjSbArNTcegpcQn' => $this->can('maging-queue'),
        ];
    }
}
