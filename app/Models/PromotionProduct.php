<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PromotionProduct
 * 
 * @property int $promotion_id
 * @property int $product_id
 * 
 * @property Promotion $promotion
 * @property Product $product
 *
 * @package App\Models
 */
class PromotionProduct extends Model
{
	protected $table = 'promotion_product';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'promotion_id' => 'int',
		'product_id' => 'int'
	];

	public function promotion()
	{
		return $this->belongsTo(Promotion::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
