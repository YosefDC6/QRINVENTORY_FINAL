<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'price',
        'quantity',  
        'min_stock',
        'qr_code',   
        'active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventoryMovements()
{
    return $this->hasMany(InventoryMovement::class);
}

}
