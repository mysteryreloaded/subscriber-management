<?php

namespace App\Http\Resources;

use App\Models\Field;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 * @property Collection|Field[] $fields
 */

class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'state' => $this->state,
            'fields' => $this->fields,
        ];
    }
}
