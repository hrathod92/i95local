<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    protected $table = 'video_types';
    protected $fillable = [ 'title'];
    public $timestamps = false;
}

