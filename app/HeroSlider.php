<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
	protected $table = 'hero_sliders';
	protected $fillable = [ 'title', 'image', 'caption', 'url', 'button_text'];

}
