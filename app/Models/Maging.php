<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maging extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'expended'
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

    public static function todaysForUser($user) {
        return static::where('user_id', $user->id)
            ->todays()
            ->firstOrNew(['user_id' => $user->id]);
    }
}
