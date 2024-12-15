<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    public $items = null;
	// public $totalQty = 0;
	// public $totalPrice = 0;

	public function __construct($oldFavourite){
		if($oldFavourite){
			$this->items = $oldFavourite->items;
			// $this->totalQty = $oldFavourite->totalQty;
			// $this->totalPrice = $oldFavourite->totalPrice;
		}
	}

	public function add($item, $id){
        
            $favourite = ['qty'=>0, 'price' => $item->promotion_price, 'item' => $item];
       
       
           
       
		
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$favourite = $this->items[$id];
			}
		}
		$favourite['qty']++;
        if ($item->promotion_price != 0) {
            $favourite['price'] = $item->promotion_price * $favourite['qty'];
            // $this->totalPrice += $item->promotion_price;
        }
        else {
            $favourite['price'] = $item->unit_price * $favourite['qty'];
            // $this->totalPrice += $item->unit_price;
        }
		
		$this->items[$id] = $favourite;
		$this->totalQty++;
		
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]['qty'];
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		// $this->totalQty--;
		// $this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		// $this->totalQty -= $this->items[$id]['qty'];
		// $this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
