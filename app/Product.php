<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';
	protected $fillable = [ 'product_type_id', 'status_id', 'title', 'body', 'stripe_plan_id' ];
	public $timestamps = true;
	
  public function product_type() { return $this->belongsTo( 'App\ProductType' ); }
  public function status() { return $this->belongsTo( 'App\Status' ); }
}
