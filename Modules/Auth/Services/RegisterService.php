<?php

namespace Modules\Auth\Services;

use Modules\User\Models\User;

class RegisterService
{
    public function register(array $validated ,User $user): ?User {

    
       $user =  $user->addNewUser($validated);

        return $user;

    }





}
