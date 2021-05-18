<?php

namespace App\Http\Resources;

use App\Exports\MagingExport;
use App\Models\Maging;
use Arr;
use Illuminate\Http\Resources\Json\JsonResource;

class ExportMaging extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'date' => $this->created_at,
            'kamas' => $this->expended,
            'attempts' => $this->attempts,
            'exo_attempts' => $this->exo_attempts,
            'exo_successes' => $this->exo_successes,
        ];
    }
}
