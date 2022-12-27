<?php

namespace App\Models;

use App\Enums\FieldTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Field extends Model
{
    use HasFactory;

    const TABLE = 'fields';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'type',
    ];

    protected $casts = [
        'type' => FieldTypeEnum::class
    ];

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class)->withPivot('value');
    }
}
