<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CollectionTranslation
 */
class CollectionTranslation extends Model
{
    protected $table = 'collection_translations';

    public $timestamps = true;

    protected $fillable = [
        'type',
        'locale',
        'collection_id'
    ];

    protected $guarded = [];

    public function collection()
    {
        return $this->belongsTo('App\Models\Collection', 'id');
    }
}