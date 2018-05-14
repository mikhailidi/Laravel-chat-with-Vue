<?php

namespace App\Http\Controllers\Auth;

use Modules\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Ramsey\Uuid\Uuid;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->redirectTo = route('chat.index');
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
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:36',
            'username' => 'nullable|unique:users|regex:/[a-z\d_]{3,60}$/i|max:60',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $userName = $data['username'] ?: $this->createUserName($data);
        $userName = preg_replace('/\s+/', '', $userName);
        $userName = substr($userName, 0, 59);

        return User::create([
            'username' => strtolower($userName),
            'first_name' => $this->prepareUserString($data['first_name']),
            'last_name' => $this->prepareUserString($data['last_name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => Uuid::uuid4()->toString()
        ]);
    }

    /**
     * Prepare user first and last name for DB
     *
     * @param $string
     * @return mixed|string
     */
    protected function prepareUserString($string)
    {
        $string = trim($string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = ucwords($string);

        return $string;
    }

    /**
     * Creates standard username by connecting user last and first name
     *
     * @param array $data
     * @return string
     */
    protected function createUserName(array $data)
    {
        $username = strtolower($data['first_name']) . '.' . strtolower($data['last_name']);
        $username = trim($username);

        $i = 0;
        while (!$i) {
            $isTaken = User::where('username', $username)->first();

            if ($isTaken) {
                $username .= random_int(1, 9);
                continue;
            }
            $i++;
        }

        return $username;
    }
}
