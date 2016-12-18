<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq
 */
class Faq extends Model
{
    protected $table = 'faq';

    public $timestamps = true;

    protected $fillable = [];

    protected $guarded = [];


    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('FaqTranslation')->where('locale', '=', $language);
    }
}