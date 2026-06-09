<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';   // указываем правильный первичный ключ
    public $incrementing = true;         // если автоинкремент
    protected $keyType = 'int';          // тип ключа

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Связи – не забываем указать внешний ключ (user_id), так как он нестандартный
    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    public function support_tickets()
    {
        return $this->hasMany(SupportTicket::class, 'user_id', 'user_id');
    }

    // Метод для проверки администратора (если роль 'admin')
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}