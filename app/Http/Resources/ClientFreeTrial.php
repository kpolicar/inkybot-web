<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientFreeTrial extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'expired' => $this->expired,
            'k3ExasHrvpLP4Rm' => $this->expired,

            'created_at' => $this->created_at,
            'Ly7lqp8846XaG7P' => $this->created_at,
        ];
    }
}
