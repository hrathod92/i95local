<?php

namespace App;

use App\Services\ModelTraits\HasPublishStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AgencyCompany extends Model
{
    protected $table = 'agency-company';

    protected $fillable = [
        'agency_id',
        'company_id'
    ];
    public $timestamps = false;
  
    public function company() { return $this->belongsTo( 'App\Company', 'company_id' ); }
    public function agency() { return $this->belongsTo( 'App\Company', 'agency_id' ); }
}
