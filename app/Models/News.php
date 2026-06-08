<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * 
 * @property int $news_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string|null $image
 * @property Carbon $published_at
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class News extends Model
{
	protected $table = 'news';
	protected $primaryKey = 'news_id';

	protected $casts = [
		'published_at' => 'datetime',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'title',
		'slug',
		'content',
		'image',
		'published_at',
		'is_active'
	];
}
