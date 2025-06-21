<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $table = 'categories';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "int";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'image', 'slug'];

    public function boardingHouses(): HasMany
    {
        return $this->hasMany(BoardingHouse::class, 'category_id', 'id');
    }
}
