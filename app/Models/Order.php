<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $order_id
 * @property int|null $user_id
 * @property string $order_number
 * @property string $status
 * @property float $total_price
 * @property string $delivery_address
 * @property string $phone
 * @property string|null $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	protected $primaryKey = 'order_id';

	protected $casts = [
		'user_id' => 'int',
		'total_price' => 'float'
	];

	protected $fillable = [
		'user_id',
		'order_number',
		'status',
		'total_price',
		'delivery_address',
		'delivery_method',    
    	'payment_method',
		'phone',
		'comment'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
