<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'administrador' => (int) strripos($request->email, 'cni.administrador') != false
        ]);
        $user->save();
        return response()->json([
            'message' => 'Usuário criado com sucesso!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Usuário ou senha inválidos.'
            ], 401);

        $user = $request->user();
        if($user->administrador){
            $tokenResult = $user->createToken('Personal Access Token', ['administrador']); 
        }else{
            $tokenResult = $user->createToken('Personal Access Token', ['usuario']); 
        }
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logout realizado com sucesso!'

        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function profile(Request $request)
    {
        return response()->json(new UserResource(User::findOrFail($request->user()->id)));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::find($request->user()->id);
        $params = [
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ];
        $user->fill($params)->save();
        return response()->json([
            'message' => 'Usuário atualizado com sucesso!'
        ], 201);
    }
}
