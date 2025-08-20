<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return collect(parent::toArray($request))
        ->filter(function ($value) {

            return ! is_null($value);
        
        })->toArray();
        
    }
}
