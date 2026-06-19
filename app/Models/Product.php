<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $casts = [
        'category_id' => 'int',
        'price' => 'float',
        'stock' => 'int',
        'is_active' => 'bool'
    ];

    // Добавляем поля для перевода
    protected $fillable = [
        'category_id',
        'name',
        'name_en',          // английское название
        'slug',
        'price',
        'stock',
        'description',
        'description_en',   // английское описание
        'main_image',
        'is_active'
    ];

    // Аксессор для названия
    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->name_en)) {
            return $this->name_en;
        }
        return $value; // русское название
    }

    // Аксессор для описания
    public function getDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->description_en)) {
            return $this->description_en;
        }
        return $value;
    }

    // Остальные связи и методы без изменений
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'product_id', 'product_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id')
                    ->orderBy('sort_order', 'asc');
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_product', 'product_id', 'promotion_id');
    }

    public function getActivePromotionAttribute()
    {
        $today = now()->toDateString();
        return $this->promotions()
            ->where('is_active', true)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();
    }

    public function getDiscountedPriceAttribute()
    {
        $promo = $this->active_promotion;
        if ($promo && $promo->discount_percent) {
            return round($this->price * (1 - $promo->discount_percent / 100), 2);
        }
        return $this->price;
    }

    public function getHasDiscountAttribute()
    {
        return $this->discounted_price < $this->price;
    }

    public function getTotalSoldAttribute()
    {
        return $this->order_items()->sum('quantity');
    }
}