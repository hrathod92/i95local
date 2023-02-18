<?php


namespace App\Policies\Concerns;


use App\User;

trait AuthorizesAdmins
{
    public function before(User $user)
    {
        if ($user->role == 'admin') {
            return true;
        }
        return null;
    }
}