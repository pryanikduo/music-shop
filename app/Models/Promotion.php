<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Promotion
 * 
 * @property int $promotion_id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property int|null $discount_percent
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string|null $image
 * @property bool $show_on_slider
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Promotion extends Model
{
	protected $table = 'promotions';
	protected $primaryKey = 'promotion_id';

	protected $casts = [
		'discount_percent' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'show_on_slider' => 'bool',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'title',
		'slug',
		'description',
		'discount_percent',
		'start_date',
		'end_date',
		'image',
		'show_on_slider',
		'is_active'
	];

	public function products()
	{
		return $this->belongsToMany(Product::class, 'promotion_product');
	}
}
