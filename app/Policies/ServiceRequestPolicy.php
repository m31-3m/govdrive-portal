<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    public function view(User $user, ServiceRequest $request): bool
    {
        return $user->id === $request->user_id || $user->role === 1;
    }

    public function update(User $user, ServiceRequest $request): bool
    {
        return $user->id === $request->user_id || $user->role === 1;
    }

    public function delete(User $user, ServiceRequest $request): bool
    {
        return $user->id === $request->user_id || $user->role === 1;
    }

    public function updateStatus(User $user): bool
    {
        return $user->role === 1;
    }
}