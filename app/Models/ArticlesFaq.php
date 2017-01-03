<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesFaq extends Model
{
    protected $table = 'articles_faqs';

    public $timestamps = true;

    protected $fillable = [
        'article_id',
        'faq_id'
    ];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
    public function faq()
    {
        return $this->belongsTo('App\Models\Faq');
    }
}
