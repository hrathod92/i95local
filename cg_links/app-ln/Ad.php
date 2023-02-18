<?php

namespace App;

use App\Services\ModelTraits\HasPublishStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasPublishStatus;

    protected $table = 'ads';

    protected $fillable = [
        'type',
        'slug',
        'class',
        'title',
        'body',
        'image',
        'random_weight',
        'ad_type_id',
        'company_id',
        'publish_start_at',
        'publish_end_at',
        'status_id',
        'publish_status_id',
        'image_alt'
    ];

    protected $dates = [
        'publish_start_at',
        'publish_end_at',
    ];

    private $rules = array(
        'title' => 'required|min:6',
    );  
  
  
    public $timestamps = true;
  
    public function company() { return $this->belongsTo( 'App\Company' ); }
    public function ad_type() { return $this->belongsTo( 'App\AdType' ); }
    public function status() { return $this->belongsTo( 'App\Status' ); }
    public function publish_status() { return $this->belongsTo( 'App\PublishStatus' ); }
    public function category() { return $this->belongsTo( 'App\Category' ); }

    /**
     * Scope a query to only include active.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWherePublic(Builder $query)
    {

        return $query
            ->wherePublished()
            ->where(function (Builder $query) {

                $now = Carbon::now();
                $query
                    ->where(function (Builder $query) use ($now) {
                        $query
                            ->whereNull('publish_start_at')
                            ->orWhere('publish_start_at', '<=', $now);
                    })
                    ->Where(function (Builder $query) use ($now) {
                        $query
                            ->whereNull('publish_end_at')
                            ->orWhere('publish_end_at', '>=', $now);
                    });
            });
    }
  
    public function scopeCategory( $query, $categoryID )
    {
      return $query->where( 'category_id', $categoryID );
    }

}
