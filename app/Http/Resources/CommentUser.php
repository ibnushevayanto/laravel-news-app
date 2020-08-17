<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CommentUser extends JsonResource
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
            /*
            * $this->when()
            * Kondisional dalam menampilkan data

            * parameter pertama harus bernilai true / false
            * parameter kedua data yang ingin ditampilkan jika nilai adalah true
            */
            'email' => $this->when(true, $this->email)
        ];
    }
}
