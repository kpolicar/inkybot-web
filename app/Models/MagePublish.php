<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagePublish extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'dont_publish_to_forum',
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function($model) {
            optional($model->user)->userCacheAttributesNumberOfExoMagesLeftInPlanClearCache();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePostedOnForum($query)
    {
        return $query->whereNotNull('ex_thread_id');
    }
}
