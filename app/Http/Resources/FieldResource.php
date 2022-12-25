<?php

namespace App\Http\Resources;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $value
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property Collection|Subscriber[] $subscribers
 */

class FieldResource extends JsonResource
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
            'title' => $this->title,
            'value' => $this->value,
            'type' => $this->type,
            'subscribers' => $this->subscribers,
        ];
    }
}
