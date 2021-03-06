<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Miniature extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'points' => $this->points,
            'specialists' => $this->specialists->pluck('name'),
            'armament' => $this->decode($this->armament),
            'wargear_options' => $this->wargearoptions->map(function ($x) {
                return [
                    'who' => $x->who,
                    'may' => $x->may,
                    'replace' => $this->decode($x->replace),
                    'method' => $x->method,
                    'options' => $this->decode($x->options),
                ];
            }),
        ];
    }

    protected function decode($json)
    {
        return json_decode($json);
    }
}
