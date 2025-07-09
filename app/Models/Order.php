<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'product_name',
    //     'total_price',
    //     'status',
    // ];

    protected $fillable = [
        'user_id',
        'product_name',
        'total_price',
        'status',
        'shipping_method',
        'shipping_cost',
        'payment_image',
        'no_resi', // tambahkan ini
    ];


    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentProofs()
    {
        return $this->hasMany(PaymentProof::class);
    }
}

