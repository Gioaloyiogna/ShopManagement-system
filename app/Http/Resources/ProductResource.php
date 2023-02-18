<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "pack_price" => $this->pack_price,
            "unit_price" => $this->unit_price,
            "product_quantity"=>$this->product_quantity,
            "product_code"=>$this->product_code,
            'action' =>
            "
           <div>
           <button class='table-edit-btn'><i class='bx bx-pencil'></i></button>
         <button class='table-trash-btn'> <i class='bx bxs-trash-alt'></i></button>
           </div>   
            "
        ];
    }
}
