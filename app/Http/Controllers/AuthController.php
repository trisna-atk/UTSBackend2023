<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //membuat fitur register
    public function register(Request $request) {
        $input = [
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password) 
        ];

        $user = User::create($input);

        $data = [
            'messege' => 'User is created succesfully'
        ];

        //mengirim response json 
        return response()->json($data, 200);
    }

    //membuat fitur login 
    public function login(Request $request) {
        $input = [
            'email' => $request->email, 
            'password' => $request->password
        ];

        //melakukaan autentikasi 
        if (Auth::atempt($input)) {
            $token = Auth::user()->createToken('auth_token');

            $data = [
                'messege' => 'Login Succesfully', 
                'token' => $token->PlainTextToken
            ];

            //mengembalikan response json 
            return response()->json($data, 200);
        } else {
            $data = [
                'messege' => 'Username or Password is wrong'  
            ];

            return response()->json($data, 401);
        }
    }
}
