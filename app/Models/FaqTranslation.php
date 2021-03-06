<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
/**
 * Class FaqTranslation
 */
class FaqTranslation extends Model
{
    protected $table = 'faq_translations';

    public $timestamps = true;

    protected $fillable = [
        'question',
        'answer',
        'locale',
        'faq_id'
    ];

    protected $guarded = [];

    public function faq()
    {
        return $this->belongsTo('App\Models\Faq');
    }
}