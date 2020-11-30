<?php

namespace App\Policies;

use App\User;
use App\PartsRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartsRequestPolicy
{
    use HandlesAuthorization;

    // Create (create-parts-request) is handled by AuthServiceProvider

    public function view(User $user, PartsRequest $partsRequest)
    {
        // Admins can view request 
        if ($user->hasRole(['super-admin', 'admin'])) return true;

        // Owner can view request 
        if ($partsRequest->user_id == $user->id) return true;

        // Suppliers that are can deliver here can view request
        if ($user->isSupplier() && $user->canDeliver($partsRequest)) return true;
    }



    public function bid(User $user, PartsRequest $partsRequest)
    {
        // Expired
        if ($partsRequest->expired) return false;

        // A bid already accepted
        if (null !== $partsRequest->acceptedBid()) return false;

        // User not supplier
        if (!$user->hasRole(['supplier'])) return false;

        // User not inactive
        if ($user->suspended) return false;

        // User can supply this postcode
        if (!$user->canDeliver($partsRequest)) return false;

        // Not already bidded
        if ($user->hasBidded($partsRequest)) return false;

        // Okay you can bid
        return true;
    }
}
