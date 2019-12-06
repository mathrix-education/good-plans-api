<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function saving(User $user)
    {
        // Password hash
        if (isset($user->password) && Hash::needsRehash($user->password)) {
            $user->password = Hash::make($user->password);
        }

        return true;
    }
}
