<?php

namespace App\Observers;

use App\Events\MagePublishUploaded;
use App\Models\MagePublish;

class MagePublishObserver
{
    public function created(MagePublish $magePublish)
    {
        if ($magePublish->image_path && !$magePublish->ex_thread_id)
            MagePublishUploaded::dispatch($magePublish);
    }
}
