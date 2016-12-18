<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('Faq');
    }
}