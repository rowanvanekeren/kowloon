<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesTranslation extends Model
{
    protected $table = 'images_translations';

    public $timestamps = true;

    protected $fillable = [
        'image',
        'description',
        'locale',
        'image_id'
    ];

    protected $guarded = [];

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }
}
