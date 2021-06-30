<?php namespace App\Models\Traits;


// Todo: Remove x3 multipliers (this is meant for old versions)
trait UserThrottles
{
    public function getPublishRateLimitPerHourAttribute()
    {
        return 3 * 3 * optional($this->validSubscription())->quantity ?? 1; // 3 per hour for each subscription
    }

    public function getNotificationRateLimitPerMinuteAttribute()
    {
        return 3 * 5 * optional($this->validSubscription())->quantity ?? 1; // 5 per minute for each subscription
    }

    public function getCreateStatisticsRateLimitPerMinuteAttribute()
    {
        return 3 * 6 * optional($this->validSubscription())->quantity ?? 1; // 6 per minute for each subscription
    }

    public function getViewStatisticsRateLimitPerMinuteAttribute()
    {
        return 3 * 15 * optional($this->validSubscription())->quantity ?? 1; // 15 per minute for each subscription
    }
}
