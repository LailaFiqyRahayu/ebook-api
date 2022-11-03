<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function me(){
        return [
            'NIS' => 3103120126,
            'Name' => 'Laila Fiqy',
            'Phone' => '081226969099',
            'Class' => 'XII RPL 4'
        ];
    }

    public function register(Request $request)
    {
        $field = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => bcrypt($field['password'])
        ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) // kalau nemu user nya tapi passwordnya nggak nemu 
            return response([
                'message' => 'unauthorized'
            ], 401);
            $token = $user->createToken('tokenku')->plainTextToken;

    $response = [
        'user' =>$user,
        'token' => $token
    ];

    return response($response, 201);
        

    
    
}
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete(); //menghapus token yang saat itu saja, bukan menghapus semua token
    
        return [
            'message' => 'Logged out'
        ];
    }
}

    


