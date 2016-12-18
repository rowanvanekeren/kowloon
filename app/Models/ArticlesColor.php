<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticlesColor
 */
class ArticlesColor extends Model
{
    protected $table = 'articles_colors';

    public $timestamps = true;

    protected $fillable = [
        'article_id',
        'color_id'
    ];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }
}