<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $primaryKey = 'promotion_id';

    protected $casts = [
        'discount_percent' => 'int',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'show_on_slider' => 'bool',
        'is_active' => 'bool'
    ];

    protected $fillable = [
        'title',
        'title_en',           // английский заголовок
        'slug',
        'description',
        'description_en',     // английское описание
        'discount_percent',
        'start_date',
        'end_date',
        'image',
        'show_on_slider',
        'is_active'
    ];

    // Аксессор для заголовка
    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->title_en)) {
            return $this->title_en;
        }
        return $value;
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

    // Остальные связи без изменений
    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_product', 'promotion_id', 'product_id');
    }
}