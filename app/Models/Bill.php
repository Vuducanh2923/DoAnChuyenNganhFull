<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillDetail;
use App\Models\Customer;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
  
    public function customer()
    {
        return $this->belongsTo(Customer::class,'id_customer','id');
    }
    public function billDetail()
    {
        return $this->hasMany(BillDetail::class, 'id_bill', 'id');
    }
     
}
