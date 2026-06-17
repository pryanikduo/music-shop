<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        'title_en',              // английский заголовок
        'content',
        'content_en',            // английское содержание
        'meta_description',
        'meta_description_en',   // английское мета-описание (если добавили)
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

    // Аксессор для контента
    public function getContentAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->content_en)) {
            return $this->content_en;
        }
        return $value;
    }

    // Аксессор для мета-описания (если нужно)
    public function getMetaDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->meta_description_en)) {
            return $this->meta_description_en;
        }
        return $value;
    }
}