<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CartItem
 * 
 * @property int $cart_item_id
 * @property int|null $user_id
 * @property string|null $session_id
 * @property int $product_id
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 * @property Product $product
 *
 * @package App\Models
 */
class CartItem extends Model
{
	protected $table = 'cart_items';
	protected $primaryKey = 'cart_item_id';

	protected $casts = [
		'user_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'user_id',
		'session_id',
		'product_id',
		'quantity'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'product_id');
	}
}
