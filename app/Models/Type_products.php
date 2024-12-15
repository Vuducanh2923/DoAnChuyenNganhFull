<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Type_products extends Model
{
    use HasFactory;
    protected $table = 'type_products';
    
    public function products() {
       return $this->hasMany(Product::class, 'id_type', 'id');
    }
}
