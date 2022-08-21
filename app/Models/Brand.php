<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'country', 'description'
    ];
    protected $table = 'brands';
    public function Img()
    {
        return $this->morphMany(Img::class, 'product', 'type');
    }
}
