<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;
class BillDetail extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu cần
    protected $table = 'bill_detail';

    // Định nghĩa quan hệ với Bill
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'id_bill', 'id');
    }

    // Định nghĩa quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}

