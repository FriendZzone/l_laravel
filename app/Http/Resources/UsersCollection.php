<?php

namespace App\Http\Resources;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $dataReturn = [
            'data' => $this->collection,
            'posts' => PostsResource::collection($this->collection)

        ];
        return $dataReturn;
    }
}
