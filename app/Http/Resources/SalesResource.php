<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "product_name" => $this->product_name,
            "unit_price" =>$this->unit_price,
            "product_quantity" => $this->product_quantity,
            "cost" => $this->unit_price*$this->product_quantity,
            'action' =>
            "
           <div>
           <i class='bx bx-pencil'></i>
           <i class='bx bxs-trash-alt'></i>
           </div>   
            "
        ];
    }
}
