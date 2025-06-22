<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    public $table = 'cities';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "int";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'images', 'slug'];

    public function boardingHouses(): HasMany
    {
        return $this->hasMany(BoardingHouse::class, 'city_id', 'id');
    }

}
