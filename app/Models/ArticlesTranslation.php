<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticlesTranslation
 */
class ArticlesTranslation extends Model
{
    protected $table = 'articles_translations';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'price',
        'collection_id',
        'category_id',
        'article_id',
        'specification_id',
        'locale'
    ];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    public function collection()
    {
        return $this->hasOne('App\Models\Collection', 'id', 'collection_id');
    }
    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function specification()
    {
        return $this->hasOne('App\Models\Specification','id', 'specification_id');
    }
        
}