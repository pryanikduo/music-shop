<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * @property int $order_item_id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price_at_time
 * @property Carbon|null $created_at
 * 
 * @property Order $order
 * @property Product $product
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	protected $table = 'order_items';
	protected $primaryKey = 'order_item_id';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'int',
		'price_at_time' => 'float'
	];

	protected $fillable = [
		'order_id',
		'product_id',
		'quantity',
		'price_at_time'
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'order_id', 'order_id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'product_id');
	}
}
