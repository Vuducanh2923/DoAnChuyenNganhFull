<?php

namespace App\Models;

use App\Models\BillDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type_products;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public function type_products() {
       return $this->belongsTo(Type_products::class, 'id_type', 'id');
    }
    public function scopeSearch($query){
        $name = request()->name;
        $gia = request()->gia;
        if($key = request()->key) {
            $query = $query-> whereHas('type_products', function ($query) use ($key) {
                $query->where('name', 'LIKE', '%' . $key . '%');
            })
            ->orwhere('description','like', '%' . $key . '%')
            ->orWhere('name', 'LIKE', '%'.$key.'%')
            ->orWhere('unit_price', 'LIKE', '%'.$key.'%')
            ->orWhere('promotion_price', 'LIKE', '%'.$key.'%')
            // ->orderBy('name',$name)
            // ->orderBy('unit_price',$gia)
            ;
        }
        else {
            Product::all();
        }
        return $query;
    }
    public function billDetail(){
        return $this->hasMany(BillDetail::class,'id_product','id');
    }
    
}
