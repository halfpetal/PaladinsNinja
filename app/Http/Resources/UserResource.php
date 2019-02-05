<?php

namespace PaladinsNinja\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = [];

        if (\Route::current()->getName() === 'api.user.v1.show') {
            $user = [
                'email' => $this->email
            ];
        }

        return array_merge($user, [
            'id' => $this->uuid,
            'username' => $this->username,
            'avatar_url' => \Gravatar::get($this->email),
            'paladins_id' => $this->paladins_player_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
    }
}
