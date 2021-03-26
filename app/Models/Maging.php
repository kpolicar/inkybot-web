<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\View\Engine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maging extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'expended'
    ];

    protected $casts = [
        'exo_attempts' => 'array',
        'exo_successes' => 'array',
    ];

    protected $attributes = [
        'expended' => 0,
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeTodays($query) {
        return $query->whereDate('created_at', Carbon::today());
    }

    public static function Runes() {
        return require database_path('runes.php');
    }

    public static function todaysForUser($user) {
        return static::where('user_id', $user->id)
            ->todays()
            ->firstOrNew(['user_id' => $user->id]);
    }
}
