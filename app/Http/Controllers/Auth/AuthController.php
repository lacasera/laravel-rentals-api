<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
      * Get the authenticated User.
      *
      * @return \Illuminate\Http\JsonResponse
    */
     public function me()
     {
        return response()->json(auth()->user());
     }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function logout(Request $request)
     {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
     }

     /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {

       if (auth()->attempt($request->only('email', 'password'))) {

           $user = auth()->user();

           $access_token = $user->createToken(config('app.name'))->accessToken;

           return response()->json(compact('user', 'access_token'), 200);
       }

       return response()->json(['error' => 'user not found'], 404);
    }
}
