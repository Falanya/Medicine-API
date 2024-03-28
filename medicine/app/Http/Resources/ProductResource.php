<?php

namespace App\Http\Resources;

use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }
    public function toArray(Request $request): array {
        $percent_sale = 0;
        if($this->discount > 0 && $this->discount < $this->price) {
            $percent_sale = ($this->price - $this->discount) / $this->price * 100;
        }
        $product = ProductOrder::where('product_id', $this->id)->get();
        $sold_out = $product->count();

        return([
            'id' => $this->id,
            'name' => $this->name,
            'type_id' => $this->type_id,
            'describe' => $this->describe,
            'info' => $this->info,
            'quantity' => $this->quantity,
            'price' => number_format($this->price),
            'discount' => number_format($this->discount),
            'percen_sale' => floor($percent_sale).'%',
            'view' => $this->view,
            'img' => $this->img,
            'sold_out' => $sold_out,
            'status' => $this->status == 1 ? 'Show' : 'Hidden',
            'slug' => $this->slug,
            'img_details' => ImgProductResource::collection($this->img_details),
            'comment' => CommentResource::collection($this->comments),
        ]);
    }
}
