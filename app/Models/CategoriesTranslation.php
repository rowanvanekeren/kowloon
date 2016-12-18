<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoriesTranslation
 */
class CategoriesTranslation extends Model
{
    protected $table = 'categories_translations';

    public $timestamps = true;

    protected $fillable = [
        'type',
        'locale',
        'category_id'
    ];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('Category');
    }
}