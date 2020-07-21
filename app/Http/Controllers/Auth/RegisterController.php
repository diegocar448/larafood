<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Services\TenantService;
use App\Tenant\Events\TenantCreated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = "/admin";

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

        //dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'min:255', 'confirmed'],
            'empresa' => ['required', 'string', 'min:3', 'max:255', 'unique:tenants,name'],
            'cnpj' => ['required', 'numeric', 'min:14', 'max:14', 'unique:tenants'],
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

        if (!$plan = session('plan')) {
            return redirect()->route('site.home');
        }

        $tenantService = app(TenantService::class);

        ///////////////////////////////////////////////////////////
        ////////////Retornará o usuário cadastrado/////////////////
        ///////////////////////////////////////////////////////////
        $user = $tenantService->make($plan, $data);

        event(new TenantCreated($user));

        return $user;




        /* return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]); */
    }
}
