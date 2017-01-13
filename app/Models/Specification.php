<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
/**
 * Class Specification
 */
class Specification extends Model
{
    protected $table = 'specifications';

    public $timestamps = true;

    protected $fillable = [];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\ArticleTranslation','specification_id');
    }
    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('App\Models\SpecificationsTranslation')->where('locale', '=', $language);
    }
    public function alltranslation($language = null)
    {

        return $this->hasMany('App\Models\SpecificationsTranslation');
    }
}