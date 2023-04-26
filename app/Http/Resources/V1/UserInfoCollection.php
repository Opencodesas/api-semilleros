<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserInfoCollection extends ResourceCollection
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
            "success" => true,
            "action" => "Consulta users info",
            'items'=>$this->collection,
            'meta'=>[
                'organization'=>'OpenCode SAS',
                'authors'=>'Jorge Usuga'
            ],
            'type'=>'users_infor'
        ];
    }
}
