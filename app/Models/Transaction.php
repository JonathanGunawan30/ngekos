<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    public $table = 'transactions';
    public $timestamps = true;
    public $incrementing = true;
    protected $keyType = "int";
    protected $primaryKey = "id";
    protected $fillable = [
        'code',
        'boarding_house_id',
        'room_id',
        'name',
        'email',
        'phone_number',
        'payment_method',
        'payment_status',
        'start_date',
        'duration',
        'total_amount',
        'transaction_date',
    ];

    public function boardingHouse(): BelongsTo
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }
}
