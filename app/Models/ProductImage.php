<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 * 
 * @property int $img_id
 * @property int $product_id
 * @property string $image_path
 * @property int $sort_order
 * @property Carbon|null $created_at
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class ProductImage extends Model
{
	protected $table = 'product_images';
	protected $primaryKey = 'img_id';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'sort_order' => 'int'
	];

	protected $fillable = [
		'product_id',
		'image_path',
		'sort_order'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
