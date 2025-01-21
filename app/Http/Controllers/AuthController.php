<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Enregistrement d'un nouvel utilisateur
    public function register(Request $request)
    {
        // Validation des données
        $validator = validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:20|min:9|unique:users',
            // 'role' => 'required|string|in:admin,client',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
        ]);


        return response()->json(['user' => $user], 201);
    }

    // Connexion d'un utilisateur

    public function login(Request $request)
    {
        // Validation
        $validator = validator($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');
        $token = auth()->attempt($credentials);

        if (!$token) {
            return response()->json(["message" => "Informations incorrects"], 401);
        }

        $user = auth()->user();


        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer",
            "user" => $user,
            "role" => $user->role, // Ajoutez ici le rôle si nécessaire
            "expires_in" => env('JWT_TTL') * 60 . " secondes"
        ]);
    }

    // Deconnexion d'un utilisateur
    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json(['message' => 'Deconnexion effectuée']);
    }
}
