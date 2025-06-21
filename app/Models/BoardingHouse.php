<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoardingHouse extends Model
{
    public $table = 'boarding_houses';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "int";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'city_id',
        'category_id',
        'description',
        'price',
        'address'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'boarding_house_id', 'id');
    }

    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class, 'boarding_house_id', 'id');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class, 'boarding_house_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'boarding_house_id', 'id');
    }
}
