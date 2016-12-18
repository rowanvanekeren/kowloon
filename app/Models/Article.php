<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\ArticlesTranslation;
use App\Models\Color;
/**
 * Class Article
 */
class Article extends Model
{
    protected $table = 'articles';

    public $timestamps = true;

    protected $fillable = [
        'image'
    ];

    protected $guarded = [];

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('App\Models\ArticlesTranslation')->where('locale', '=', $language);
    }


    public function color()
    {
        return $this->belongsToMany('App\Models\Color', 'articles_colors');
    }
        
}