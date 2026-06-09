<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $product_id
 * @property int $category_id
 * @property string $name
 * @property string $slug
 * @property float $price
 * @property int $stock
 * @property string|null $description
 * @property string|null $main_image
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Collection|CartItem[] $cart_items
 * @property Collection|OrderItem[] $order_items
 * @property Collection|ProductImage[] $product_images
 * @property Collection|Promotion[] $promotions
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	protected $primaryKey = 'product_id';

	protected $casts = [
		'category_id' => 'int',
		'price' => 'float',
		'stock' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'category_id',
		'name',
		'slug',
		'price',
		'stock',
		'description',
		'main_image',
		'is_active'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function cart_items()
	{
		return $this->hasMany(CartItem::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}

	public function product_images()
	{
		return $this->hasMany(ProductImage::class);
	}

	public function promotions()
	{
		return $this->belongsToMany(Promotion::class, 'promotion_product');
	}
}
