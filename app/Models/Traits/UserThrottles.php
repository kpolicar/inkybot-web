<?php namespace App\Models\Traits;


trait UserThrottles
{
    public function getPublishRateLimitPerHourAttribute()
    {
        return 3 * (optional($this->subscription())->quantity ?? 1); // 3 per hour for each subscription
    }

    public function getNotificationRateLimitPerMinuteAttribute()
    {
        return 5 * optional($this->subscription())->quantity ?? 1; // 5 per minute for each subscription
    }
}
