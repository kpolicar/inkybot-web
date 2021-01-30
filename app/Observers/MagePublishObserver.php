<?php

namespace App\Observers;

use App\Models\MagePublish;

class MagePublishObserver
{
    public function created(MagePublish $magePublish)
    {
        $url = asset($magePublish->image_path);
    }
}
