<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Model_has_role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'identification_type' => ['required', 'string', 'max:255'],
            'identification_number' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'identification_type' => $data['identification_type'],
            'identification_number' => $data['identification_number'],
            'age' => $data['age'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'state_record' => 'ACTIVAR',
        ]);

        Model_has_role::insert([
            'role_id'=> '2',
            'model_type' => 'App\Models\User',
            'model_id' => $user->id

        ]);

        return $user;
    }
}
?>
