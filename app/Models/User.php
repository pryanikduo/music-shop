<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CartItem[] $cart_items
 * @property Collection|Order[] $orders
 * @property Collection|SupportTicket[] $support_tickets
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'user_id';

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'role',
		'remember_token'
	];

	public function cart_items()
	{
		return $this->hasMany(CartItem::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function support_tickets()
	{
		return $this->hasMany(SupportTicket::class);
	}
}
