<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="4Ride API Dokumentacja",
     *      description="Dokumentacja API dla aplikacji mobilnej",
     *      @OA\Contact(
     *          email="poczta@sebastianpluta.pl"
     *      ),
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="4Ride localhost"
     * )
     *
     * @OA\Tag(
     *     name="PushNews",
     *     description="API Endpoints"
     * )
     * @OA\SecurityScheme(
     *      type="http",
     *      description="Zaloguj się poprzez email i hasło by pobrać token",
     *      in="header",
     *      scheme="bearer",
     *      securityScheme="apiAuth",
     * )
     *
     */
    
    public function handleResponse($result, $data = null)
    {
    	$res = $result;
        
        if($data) {

            $res = [   
            $data => $result,
        ];
        }
        
        
        return response()->json($res, 200);
    }

    public function handleError($error=null, $code = 404, $data = null)
    {
        $res = [];
        if ($error)
        {
            $res = [
                'message' => $error,
            ];
        }
        if ($data) {
            $res['data'] = $data;
        }
        
    	
        return response()->json($res, $code);
    }
}