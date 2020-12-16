<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'author_image' => $this->author_image,
            'body' => $this->body,
            'ISNI' => $this->ISNI,
            'date_of_birth' =>(string) $this->date_of_birth,
            'date_of_flourish' => (string) $this->date_of_flourish,
            'email' => $this->email,
            'contact_number' => $this->contact_number,
            'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDayDateTimeString(),
            'status' => $this->status,
            'wikilink' => $this->wikilink,
        ];
    }
}
