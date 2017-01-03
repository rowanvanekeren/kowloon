<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
class Image extends Model
{
    protected $table = 'images';

    public $timestamps = true;

    protected $fillable = [];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsToMany('App\Models\Article', 'articles_images' );
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('App\Models\ImagesTranslation')->where('locale', '=', $language);
    }
}
