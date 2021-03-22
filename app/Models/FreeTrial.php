<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeTrial extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address', 'user_id'
    ];

    protected $hidden = ['ip_address', 'user_id'];
    protected $appends = ['expired'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExpiredAttribute()
    {
        return $this->freshTimestamp()
            ->subHour()
            ->isAfter($this->created_at);
    }
}
