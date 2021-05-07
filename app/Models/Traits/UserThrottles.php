<?php namespace App\Models\Traits;


trait UserThrottles
{
    public function getPublishRateLimitPerHourAttribute()
    {
        return 3 * (optional($this->subscription())->quantity ?? 1); // 3 per hour for each subscription
    }

    public function getNotificationRatePerMinuteLimitAttribute()
    {
        return optional($this->subscription())->quantity ?? 1; // 1 per minute for each subscription
    }
}
