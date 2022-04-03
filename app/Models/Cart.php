<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'product_id',
        'oreder_id',
        'quantity'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
