<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\View\Engine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Maging extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'label', 'expended', 'time_maging'
    ];

    protected $casts = [
        'attempts' => 'array',
        'exo_attempts' => 'array',
        'exo_successes' => 'array',
    ];

    protected $attributes = [
        'time_maging' => 0,
        'expended' => 0,
    ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function($model) {
            optional($model->user)->userCacheAttributesNumberOfExoMagesLeftInPlanClearCache();
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeTodays($query) {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeLatest($query) {
        return $query->orderByDesc('created_at');
    }

    public function scopeNotTodays($query) {
        return $query->whereDate('created_at', '!=', Carbon::today());
    }

    public static function Runes() {
        return require database_path('runes.php');
    }

    public static function activeForUser($user) {
        return static::where('user_id', $user->id)
            ->todays()
            ->latest()
            ->firstOrNew(['user_id' => $user->id]);
    }
}
