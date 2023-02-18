<?php

namespace App\Policies;

use App\Policies\Concerns\AuthorizesAdmins;
use App\PublishStatus;
use App\User;

class OwnerPolicy
{
    use AuthorizesAdmins;

    public function create(User $user, $model = null)
    {
        return true;
    }

    public function update(User $user, $model = null)
    {
        return $this->isOwner($user, $model);
    }

    public function delete(User $user, $model = null)
    {
        return $this->isOwner($user, $model);
    }

    public function viewAll(User $user)
    {
        return false;
    }

    public function viewByOwner(User $user, $modelClass, User $owner)
    {
        return $user->id == $owner->id;
    }

    public function view(User $user, $model = null)
    {
        return $this->isOwner($user, $model);
    }

    public function show(User $user, $model = null)
    {
        return $this->view($user, $model);
    }

    public function setPublishStatusTo(User $user, $model, $publishStatus)
    {
        if (!$this->isOwner($user, $model)) {
            return false;
        }

        $valid = [
            PublishStatus::REVIEW,
            PublishStatus::DRAFT,
            PublishStatus::INACTIVE,
        ];

        $publishStatus = PublishStatus::toModel($publishStatus);

        return in_array($publishStatus->name, $valid);
    }

    protected function isOwner(User $user, $model = null)
    {
        if (!is_object($model)) {
            return false;
        }

        return $model->isOwner($user);
    }
}