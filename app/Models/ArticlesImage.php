<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesImage extends Model
{
    protected $table = 'articles_images';

    public $timestamps = true;

    protected $fillable = [
        'article_id',
        'image_id'
    ];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }
}
