<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return \View::make('users.index')->with(compact('users', $users));
    }

    public function show($id)
    {

        $user = User::find($id);

        $user_data = [
            ['label' => 'User ID', 'value' => $user->id],
            ['label' => 'Email Address', 'value' => $user->email],
            ['label' => 'Active?', 'value' => $user->active],

            ['label' => 'Company Name', 'value' => $user->company_name],
            ['label' => 'Company Registration Number', 'value' => $user->company_registration],
            ['label' => 'Limited Company?', 'value' => $user->limited_company],
            ['label' => 'Telephone', 'value' => $user->telephone],
            ['label' => 'Address Line 1', 'value' => $user->address_line_1],
            ['label' => 'Address Line 2', 'value' => $user->address_line_2],
            ['label' => 'Town/City', 'value' => $user->town_city],
            ['label' => 'Postcode', 'value' => $user->post_code],
            ['label' => 'Registered on', 'value' => $user->created_at],

        ];

        return view('users.show', compact('user', 'user_data'));
    }


    public function create()
    {
        if (\Auth::user()->hasRole(['super-admin', 'admin'])) {
            return \View::make('users.create');
        }
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'user_role' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_name' => ['required', 'string', 'min:4'],
            'company_registration' => ['nullable', 'string', 'min:8'],
            'limited_company' => ['nullable'],
            'telephone' => ['required', 'regex:/[0-9 ]+/', 'min:11'],
            'address_line_1' => ['required', 'string', 'min:2'],
            'address_line_2' => ['nullable', 'string', 'min:2'],
            'town_city' => ['required', 'string', 'min:3'],
            'county' => ['required', 'string', 'min:3'],
            'post_code' => ['required', 'string', 'min:4', 'regex:/([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})/'],
            'postcodes_covered' => ['required', 'string', 'min:3'],
        ]);


        // Take postcodes out of the validated data
        $postcodesCovered = array_pull($validatedData, 'postcodes_covered');

        // Take role out of the validated data
        $userRole = array_pull($validatedData, 'user_role');

        // Create new user
        $newUser = new User;
        $newUser->fill($validatedData);
        $newUser->password = Hash::make($validatedData['password']);
        $newUser->active = 1;
        $newUser->limited_company = 1;
        $newUser->save();


        // Set role after save
        $newUser->setRoleByHandle($userRole);

        // Attach postcodes to user
        $newUser->setSupplierPostcodes($postcodesCovered);

        // Email new user
        Mail::to($newUser->email)
            ->queue(new UserCreated($newUser));

        return redirect('users')->with('message', 'The new supplier has been created. They will recieve email confirmation.');
    }

    public function destroy(User $user)
    {

        // TODO? encrypt decrpt user id

        abort_unless(auth()->user()->can('delete', $user), 403);

        $user->bids()->delete();

        $user->delete();
    }
}
