<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonus extends Model
{
    public $table = 'bonuses';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "int";
    protected $primaryKey = "id";
    protected $fillable = [
        'boarding_house_id',
        'images',
        'name',
        'description',
    ];

    public function boardingHouse(): BelongsTo
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }
}
