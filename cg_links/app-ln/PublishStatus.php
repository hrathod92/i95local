<?php

namespace App;

use App\Services\ModelTraits\FindByName;
use Illuminate\Database\Eloquent\Model;

class PublishStatus extends Model
{
    use FindByName;

    const DRAFT     = 'draft';
    const REVIEW    = 'review';
    const PUBLISHED = 'published';
    const FAILED    = 'failed';
    const INACTIVE  = 'inactive';

    protected $table = 'publish_statuses';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public $timestamps = false;

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function scopeUserSelect( $query, $id=3 )
    {
      $query = $query->where( 'id', '!=', 3 )->where( 'id', '!=', 4 );
      if ( $id == 3 ) $query = $query->where( 'id', '!=', 1 );
      return $query;
    }

}
