<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    /**
     * Requirement: Authorization Policy
     */
    public function view(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->id === $serviceRequest->user_id || $user->role === 1;
    }

    public function update(User $user, ServiceRequest $serviceRequest): bool
    {
        // Allow if owner OR if Admin
        return $user->id === $serviceRequest->user_id || $user->role === 1;
    }

    public function delete(User $user, ServiceRequest $serviceRequest): bool
    {
        // Allow if owner OR if Admin
        return $user->id === $serviceRequest->user_id || $user->role === 1;
    }
        /**
     * Requirement: Role-based Authorization
     * Only Government Officials (Admin) can approve or reject requests.
     */
    public function updateStatus(User $user): bool
    {
        return $user->role === 1;
    }
}