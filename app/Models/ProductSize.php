<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_size';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_productdetail',
        'size',
        'quantity',
    ];
    public function infoSize()
    {
        return $this->belongsTo(Size::class, 'size', 'id');
    }
}
