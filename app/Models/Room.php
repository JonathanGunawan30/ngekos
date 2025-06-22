<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    public $table = 'rooms';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "int";
    protected $primaryKey = "id";
    protected $fillable = [
        'name', 'room_type', 'boarding_house_id', 'square_feet', 'price_per_month', 'is_available',
        'capacity'
    ];

    public function boardingHouse(): BelongsTo
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'room_id', 'id');
    }
}
