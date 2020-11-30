<?php

namespace App\Http\Controllers;

use App\Mail\UserActivated;
use App\Mail\UserSuspended;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ActiveUserController extends Controller
{
    public function store(Request $request)
    {

        // TODO? encrypt decrpt user id

        $user = \App\User::findOrFail(request('user_id'));

        abort_unless(auth()->user()->can('activateSuspend', $user), 403);

        $user->active = 1;
        $user->save();

        // Email
        Mail::to($user->email)
            ->queue(new UserActivated($user));
    }

    public function destroy($user_id)
    {

        // TODO encrypt decrpt user id

        $user = \App\User::findOrFail($user_id);

        abort_unless(auth()->user()->can('activateSuspend', $user), 403);

        $user->active = 0;
        $user->save();

        // Email
        Mail::to($user->email)
            ->queue(new UserSuspended($user));
    }
}
