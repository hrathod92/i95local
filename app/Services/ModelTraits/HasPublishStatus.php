<?php

namespace App\Services\ModelTraits;

use App\PublishStatus;
use App\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method
 * Trait HasPublishStatus
 * @package App\Services\ModelTraits
 */
trait HasPublishStatus
{
    static public function bootHasPublishStatus()
    {
        static::saving(function (self $model) {
            if (!$model->has('publishStatus')) {
                $model->setPublishStatus(PublishStatus::DRAFT);
            }
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function isOwner(User $user)
    {
        return $this->owner_id == $user->id;
    }

    public function scopeWhereOwner(Builder $query, User $user)
    {
        return $query->where('owner_id', $user->id);
    }

    public function publishStatus()
    {
        return $this->belongsTo(PublishStatus::class);
    }

    public function setPublishStatus($publishStatus)
    {
        $this->publish_status_id = PublishStatus::toModelOrFail($publishStatus)->id;
    }

    public function getPublishStatus()
    {
        return PublishStatus::findById($this->publish_status_id);
    }

    public function hasPublishStatus($publishStatus)
    {
        $status = PublishStatus::toModel($publishStatus);
        if ($status) {
            return $this->publish_status_id == $status->id;
        }
    }

    public function isPublished()
    {
        return $this->hasPublishStatus(PublishStatus::PUBLISHED);
    }

    public function scopeWherePublished(Builder $query)
    {
        return $query->wherePublishStatus(PublishStatus::PUBLISHED);
    }

    public function scopeWherePublishStatus(Builder $query, $publishStatus)
    {
        $publishStatusId = PublishStatus::toModelOrFail($publishStatus)->id;

        return $query->whereHas('publishStatus', function ($query) use ($publishStatusId) {
            return $query->where('id', $publishStatusId);
        });
    }

    public function scopeOrderByPublishStatus(Builder $query)
    {
//        $query->with([
//            'publishStatus' => function ($query) {
        $table = $this->getTable();
        $query->join('publish_statuses', 'publish_statuses.id', '=', $table . '.publish_status_id')
              ->orderBy('publish_statuses.display_order', 'ASC');
//            },
//        ]);
    }
}