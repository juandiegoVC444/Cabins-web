<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Model_has_role;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $rol = Model_has_role::select('model_has_roles.*')
        ->where('model_id','=',$user->id)
        ->first();
        // dd($user->load("roles"));
        return view('/customers/home/home',compact('rol'));

        // if(isset($user)){
        //     return view('/auth/home');
        // };
    }
}

?>
