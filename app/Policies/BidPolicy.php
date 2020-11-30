<?php

namespace App\Policies;

use App\User;
use App\Bid;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Bid $bid)
    {
        // Expired
        if ($bid->partsRequest->isExpired()) return false;

        // A bid already accepted
        if (null !== $bid->partsRequest->acceptedBid()) return false;

        // User not supplier
        if (!$user->hasRole(['supplier'])) return false;

        // User not inactive
        if ($user->suspended) return false;

        // User can supply this postcode
        if (!$user->canDeliver($bid->partsRequest)) return false;

        // Not already bidded
        if ($user->hasBidded($bid->partsRequest)) return false;

        // Okay you can bid
        return true;
    }

    public function view(User $user, Bid $bid)
    {
        // allow all admins
        if ($user->hasRole(['super-admin', 'admin'])) return true;

        // allow owner of bid
        if ($bid->user == $user) return true;

        // allow owner of related Parts Request
        if ($bid->partsRequest->owner == $user) return true;

        // else deny
        return false;
    }

    public function acceptRejectLines(User $user, Bid $bid)
    {
        if (auth()->user() == $bid->partsRequest->owner && !$bid->isAccepted()) return true;
    }

    public function accept(User $user, Bid $bid)
    {
        // another bid isnt accepted and this is the owner of the parts request
        if (!$bid->isAccepted() && $bid->partsRequest->owner == $user) return true;

        // else deny
        return false;
    }

    public function confirm(User $user, Bid $bid)
    {
        // another bid is accepted and this is the owner of the parts request
        if (!$bid->isConfirmed() && $bid->isAccepted() && $bid->user == $user) return true;

        // else deny
        return false;
    }
}
