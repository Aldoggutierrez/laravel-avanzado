<?php

namespace App\Http\Controllers;

use App\User;
use  Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        /** @var User $user */
        $user = User::all()->where('email',$request->get('email'))->first();

        if (!$user)
        {
            throw ValidationException::withMessages([
                'email' => 'El email no existe',
            ]);
        }
        if (!Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages([
                'password' => 'La contraseña es incorrecta',
            ]);
        }

        return response()->json([
            'token'=> $user->createToken($request->device_name)->plainTextToken
        ]);
    }
}
