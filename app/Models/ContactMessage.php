<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactMessage
 * 
 * @property int $contact_mess_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $message
 * @property bool $is_read
 * @property Carbon|null $created_at
 *
 * @package App\Models
 */
class ContactMessage extends Model
{
	protected $table = 'contact_messages';
	protected $primaryKey = 'contact_mess_id';
	public $timestamps = false;

	protected $casts = [
		'is_read' => 'bool',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'message',
		'is_read'
	];
}
