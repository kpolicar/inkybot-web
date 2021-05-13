<?php namespace App\Models\Traits;


use App\Models\Maging;
use Illuminate\Support\Facades\Cache;

trait UserCacheAttributes
{

    public function userCacheAttributesNumberOfExoMagesLeftInPlanCacheKey()
    {
        return 'user_'.$this->id.'_number_of_exo_mages_left_in_plan';
    }

    public function userCacheAttributesNumberOfExoMagesLeftInPlanClearCache()
    {
        return Cache::forget($this->userCacheAttributesNumberOfExoMagesLeftInPlanCacheKey());
    }

    public function getNumberOfExoMagesLeftInPlanAttribute()
    {
        $cacheKey = $this->userCacheAttributesNumberOfExoMagesLeftInPlanCacheKey();

        return Cache::get($cacheKey, function () use ($cacheKey) {
            $freshValue = $this->numberOfExoMagesLeftInPlan();
            Cache::put($cacheKey, $freshValue, now()->addHour());
            return $freshValue;
        });
    }
}
