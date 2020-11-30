<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'min:5', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_name' => ['required', 'string', 'min:6'],
            'company_registration' => ['required', 'string', 'min:8', 'max:12'],
            'limited_company' => ['nullable'],
            'telephone' => ['required', 'regex:/[0-9 ]+/', 'min:10'],
            'address_line_1' => ['required', 'string', 'min:3', 'max:100'],
            'address_line_2' => ['nullable', 'string', 'min:3', 'max:100'],
            'town_city' => ['required', 'string', 'min:3', 'max:100'],
            'post_code' => ['required', 'string', 'regex:/([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})/'], // postcode validator?
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // Has the password and put it back
        $password = array_pull($data, 'password');
        $data['password'] = Hash::make($password);

        // If limited company or not
        $data['limited_company'] = isset($data['limited_company']) ? 1 : 0;

        // Persist the user
        $user = User::create($data);

        // attach new user default role of buyer
        $buyerRoleObject = \App\Role::where('handle', 'buyer')->first();
        $user->roles()->attach($buyerRoleObject->id);

        // client admin users 
        $admins = User::admins()->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)
                ->queue(new \App\Mail\BuyerRegistered($user));
        }

        // return the user
        return $user;
    }

    // Override default event after registration

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user) ?: redirect()->back()->with('message', 'Thanks! One of our team will review your application. You will receive an email when your account has been activated.');
    }
}
