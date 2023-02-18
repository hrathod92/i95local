<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
	protected $table = 'company_types';
	protected $fillable = ['title'];
	public $timestamps = false;

}
