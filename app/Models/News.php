<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'bool'
    ];

    protected $fillable = [
        'title',
        'title_en',          // английский заголовок
        'slug',
        'content',
        'content_en',        // английский текст
        'image',
        'published_at',
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
}