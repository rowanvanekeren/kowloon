<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Color
 */
class Color extends Model
{
    protected $table = 'colors';

    public $timestamps = true;

    protected $fillable = [
        'hex'
    ];

    protected $guarded = [];

    public function article()
    {
        return $this->belongsToMany('App\Models\Article', 'articles_colors' );
    }
        
}