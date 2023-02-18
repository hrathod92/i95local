<?php

namespace App\Http\Controllers\Concerns;

use App\User;
use Auth;

trait HasPublishStatusHelpers
{

    function getPublishStatusList($model, $userId = null)
    {
        $user = Auth::user();

        $filterUser = false;
        $isSelf     = false;
        $canViewAll = $user->can('viewAll', $model);

        if ($userId) {
            $filterUser = User::findOrFail($userId);
            $isSelf     = $user->id == $filterUser->id;
        } else if (!$canViewAll) {
            $filterUser = $user;
        }

        if ($filterUser && !$isSelf) {
            $this->authorize('viewByOwner', [$model, $filterUser]);
        }

        $query = $model::query();

        if ($filterUser) {
            $query->where('owner_id', $filterUser->id);
        }

        return compact('filterUser', 'isSelf', 'query');
    }
}