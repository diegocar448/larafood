<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ClientResource;

class AuthClientController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
            "device_name" => "required",
        ]);


        $client = Client::where("email", $request->email)->first();


        if (!$client || !Hash::check($request->password, $client->password)) {
            //return response()->json(['message' => "Credenciais Inválidas"], 404);
            return response()->json(['message' => trans("messages.invalid_credentials")], 404);
        }


        $token = $client->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function me(Request $request)
    {
        $client = $request->user();

        return new ClientResource($client);
    }

    public function logout(Request $request)
    {
        $client = $request->user();

        //Revoke All tokens client
        $client->tokens()->delete();

        return response()->json([], 204);
    }
}
