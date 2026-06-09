<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * 
 * @property int $page_id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property string|null $meta_description
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Page extends Model
{
	protected $table = 'pages';
	protected $primaryKey = 'page_id';

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'slug',
		'title',
		'content',
		'meta_description',
		'is_active'
	];
}
