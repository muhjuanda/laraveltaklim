<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required',
            'foto' => 'required'

        ]);

        $expl = explode(',', $request->foto);
        $decode = base64_decode($expl[1]);
        $exte='png';
        if(str_contains($expl[0],'png')){
            $exte = 'png';
        }else{
            $exte = 'jpg';
        }
        $filename = date('YmdHis').'.'.$exte;
        $filepath = public_path().'/images/'.$filename;
        file_put_contents($filepath, $decode);
        $fileurl = url('/images/'.$filename);

    	User::create([
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
            'foto' => $fileurl
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where([
            'email' => $request->email,
            'password' => $request->password
        ])->first();

        if (isset($user)) {
                return $user;
        } else {
            return 'Kosong';
        }
    }
}
