<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentUser as CommentUserResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    //  * function untuk menapilkan responsenya
    public function toArray($request)
    {
        // * Costum Return Response
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            /* 
            * $this->whenLoaded()
            * Mengkondisikan jika sudah diload (Jika bersifat eager loading bukan lazy loading) maka akan menampilkan responsenya

            * parameternya adalah nama dari function relasi dari eloquent
            */
            'user' => new CommentUserResource($this->whenLoaded('user'))
        ];

        // * Reurn All Response
        // ! return parent::toArray($request);
    }
}
