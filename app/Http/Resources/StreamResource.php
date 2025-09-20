<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StreamResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'tokens_price' => $this->tokens_price,
            'type' => $this->streamType->name ?? null,
            'date_expiration' => $this->date_expiration,
        ];
    }
}
