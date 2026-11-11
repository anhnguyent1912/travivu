<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'tbl_booking';
    protected $primaryKey = 'bookingid';
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'bookingDate' => 'datetime',
            'numAdults' => 'integer',
            'numChildren' => 'integer',
            'unitPriceAdult' => 'decimal:0',
            'unitPriceChild' => 'decimal:0',
            'totalPrice' => 'decimal:0',
        ];
    }
}
