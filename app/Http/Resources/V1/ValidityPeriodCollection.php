<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ValidityPeriodCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'action' => 'Consulta periodos de validacion',
            'items' => $this->collection,
            'meta' => [
                'organization' => 'Arte y tecnologia',
                'authors' => 'Jorge Usuga'
            ],
            'type' => 'validaty_periods'

        ];
    }
}
