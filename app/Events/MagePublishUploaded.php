<?php

namespace App\Events;

use App\Models\MagePublish;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MagePublishUploaded
{
    use Dispatchable, SerializesModels;

    public $magePublish;

    public function __construct(MagePublish $publish)
    {
        $this->magePublish = $publish;
    }
}
