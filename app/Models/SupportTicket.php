<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SupportTicket
 * 
 * @property int $support_ticket_id
 * @property int|null $user_id
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property string $status
 * @property string|null $admin_reply
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class SupportTicket extends Model
{
	protected $table = 'support_tickets';
	protected $primaryKey = 'support_ticket_id';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'email',
		'subject',
		'message',
		'status',
		'admin_reply'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
