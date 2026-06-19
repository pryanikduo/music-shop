<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
        'name_en',          // английское название
        'slug',
        'type',
        'sort_order',
        'is_active'
    ];

    // Аксессор для названия
    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->name_en)) {
            return $this->name_en;
        }
        return $value;
    }

    // Остальные связи без изменений
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
        return $this->hasMany(Product::class, 'category_id', 'category_id');
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