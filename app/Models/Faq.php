<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
/**
 * Class Faq
 */
class Faq extends Model
{
    protected $table = 'faq';

    public $timestamps = true;

    protected $fillable = [];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsToMany('App\Models\Article', 'articles_faqs' );
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('App\Models\FaqTranslation')->where('locale', '=', $language);
    }

    public function alltranslation()
    {

        return $this->hasMany('App\Models\FaqTranslation');
    }
}