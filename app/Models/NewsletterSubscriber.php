<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsletterSubscriber
 */
class NewsletterSubscriber extends Model
{
    protected $table = 'newsletter_subscribers';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'active',
        'locale_subscriber'
    ];

    protected $guarded = [];

        
}