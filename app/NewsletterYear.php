<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsletterYear extends Model
{
    protected $table = 'newsletter_years';
    protected $fillable = [ 'title'];
    public $timestamps = false;
}

