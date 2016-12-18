<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
/**
 * Class Category
 */
class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = true;

    protected $fillable = [];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\ArticleTranslation','category_id');
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('App\Models\CategoriesTranslation')->where('locale', '=', $language);
    }
}