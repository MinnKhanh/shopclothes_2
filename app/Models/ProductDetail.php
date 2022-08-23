<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_detail';
    protected $fillable = [
        'id_color',
        'id_size',
        'quantity',
        'product_id',
        'price_import',
        'price_sell',
    ];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product', 'type');
    }
    public function sizeProduct()
    {
        return $this->belongsTo(Size::class, 'id_size', 'id');
    }
    public function colorProduct()
    {
        return $this->belongsTo(Color::class, 'id_color', 'id');
    }
}
