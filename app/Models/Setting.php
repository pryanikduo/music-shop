<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * 
 * @property int $settings_id
 * @property string $key
 * @property string $value
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Setting extends Model
{
	protected $table = 'settings';
	protected $primaryKey = 'settings_id';

	protected $fillable = [
		'key',
		'value',
		'type'
	];
	
	public static function getValue($key, $default = null)
	{
		$setting = self::where('key', $key)->first();
		return $setting ? $setting->value : $default;
	}
}
