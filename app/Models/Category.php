<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $category_id
 * @property int|null $parent_id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property int $sort_order
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category|null $category
 * @property Collection|Category[] $categories
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'category_id';

	protected $casts = [
		'parent_id' => 'int',
		'sort_order' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'parent_id',
		'name',
		'slug',
		'type',
		'sort_order',
		'is_active'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'parent_id');
	}

	public function categories()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function getDescendantIds()
	{
		$ids = [$this->category_id];
		foreach ($this->categories as $child) {
			$ids = array_merge($ids, $child->getDescendantIds());
		}
		return $ids;
	}
}
