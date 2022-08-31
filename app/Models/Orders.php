<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'id_customer',
        'id_user',
        'price',
        'quantity',
        'type',
        'payment_method',
        'note',
        'address',
        'discount',
        'name',
        'phone',
        'email',
        'country',
        'city',
        'district',
        'zip_code',
        'status'
    ];
    protected $cast = [
        'created_at' => 'date:Y-m-d',
        'updated-at' => 'date:Y-m-d',
    ];
}
