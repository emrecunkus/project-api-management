<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'status'       => $this->status,
            'total_price'  => (float) $this->total_price,
            'user'         => [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
                'email' => $this->user->email,
            ],
            'items' => $this->orderItems->map(function ($item) {
                return [
                    'product_id'  => $item->product_id,
                    'quantity'    => (int) $item->quantity,
                    'unit_price'  => (float) $item->unit_price,
                ];
            }),
            'created_at'   => $this->created_at->toDateTimeString(),
        ];
    }
}
