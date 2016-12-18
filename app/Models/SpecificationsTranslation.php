<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SpecificationsTranslation
 */
class SpecificationsTranslation extends Model
{
    protected $table = 'specifications_translations';

    public $timestamps = true;

    protected $fillable = [
        'dimension',
        'description',
        'size',
        'locale',
        'specification_id'
    ];

    protected $guarded = [];

    public function specification()
    {
        return $this->belongsTo('App\Models\Specification');
    }
}