<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\City;
use App\Models\Client;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;

class AuthController extends BaseController
{

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="loginClient",
     *      tags={"Auth"},
     *      summary="Logowanie klienta",
     *      description="Zwraca niektore dane klienta i token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginClientRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Login")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    
    public function login(Request $request)
    {
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            
          
            $result['first_name'] =  $auth->first_name;
            $result['last_name'] = $auth->last_name;
            $result['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken;
           
            return $this->handleResponse($result);
        }
        else{
            return $this->handleError('Brak autoryzacji.',  401);
        }
    }

   
}
