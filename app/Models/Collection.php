<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
/**
 * Class Collection
 */
class Collection extends Model
{
    protected $table = 'collection';

    public $timestamps = true;

    protected $fillable = [];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\ArticleTranslation','collection_id');
    }

    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('App\Models\CollectionTranslation','collection_id','id')->where('locale', '=', $language);
    }
        
}