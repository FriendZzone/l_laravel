<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        // $email = $request->email;
        // $password = $request->password;
        // $checkLogin = Auth::attempt([
        //     'email' => $email,
        //     'password' => $password
        // ]);
        // $response = [
        //     'status' => $checkLogin ? 200 : 401,
        //     'title' => $checkLogin ? 'Login Success' : 'Unauthorized'
        // ];

        // if ($checkLogin) {
        //     $user = Auth::user();
        //     $tokenResult = $user->createToken('auth_token');
        //     dd($user);
            
        //     // set expire time 
        //     // $tokenResult->expires_at = Carbon::now()->addMinutes(60);
        //     $expiredTime = Carbon::parse($tokenResult->expires_at)->toDateTimeString();

        //     // access token
        //     $access_token = $tokenResult->accessToken;
        //     $response['token'] = $access_token;
        //     $response['expired'] = $expiredTime;
        // }
        // return $response;
        $email = $request->email;
        $password = $request->password;
        $client = Client::where('password_client', 1)->first();
        if ($client) {
            $clientSercet = $client->secret;
            $clientId = $client->id;
            $response = Http::asForm()->post('http://127.0.0.1:8000/oauth/token', [
                'grant_type' => 'password',
                'client_id' => $clientId,
                'client_secret' => $clientSercet,
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ]);
            return $response;
        }
    }

    public function getToken(Request $request)
    {
        $user = User::find($request->user_id);
        dd($request->user()->currentAccessToken()->get());
        $token_list = $user->tokens;
        foreach ($token_list as $token) {
            dd($token->currentAccessToken);
        }
        dd($user->tokens);
        return $user->tokens();
    }

    public function refreshToken(Request $request)
    {
        $hashToken = $request->header('authorization');
        if ($hashToken) {
            $hashToken = str_replace('Bearer ', '', $hashToken);
            $token = PersonalAccessToken::findToken($hashToken);
            if ($token) {
                $tokenExpiredTime = Carbon::parse($token->created_at)->addMinutes(config('sanctum.expiration'));
                $isExpired = Carbon::now() < $tokenExpiredTime;
                if (!$isExpired) {
                    $userID = $token->tokenable_id;
                    $user = User::find($userID);
                    $user->tokens()->delete();
                    $newToken = $user->createToken('auth_token')->plainTextToken;

                    $response = [
                        'status' => 200,
                        'token' => $newToken
                    ];
                    return $response;
                }
            }
        }
    }
    public function logout(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $checkLogin = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
        if ($checkLogin) {
            $user = Auth::user();
            $deleteTokenStatus = $user->tokens()->delete();
            dd($deleteTokenStatus);
        }
    }
}
