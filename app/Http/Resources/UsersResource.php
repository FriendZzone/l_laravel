<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PostsResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $dataReturn = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'posts' => PostsResource::collection($this->whenLoaded('posts'))
        ];
        return $dataReturn;
    }
}
