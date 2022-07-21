<?php

namespace App\Http\Controllers\API;

use App\Factories\ProgrammerFactory;
use App\Helpers\PESELHelper;
use App\Http\Controllers\API\BaseController;
use App\Mail\Hello;
use App\Validators\ProgrammerValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiController extends BaseController
{
    public function createUser(Request $request)
    {
        $validator = ProgrammerValidator::validate($request->all());

         if ($validator->fails()){
            return $this->handleError($validator->errors());
         }
         $programmerFactory = new ProgrammerFactory();
         $programmer = $programmerFactory->createFrom($request->all());
         if ($programmer['send_mail']) Mail::to($programmer['programmer']->email)->send(new Hello($programmer['programmer']));

         return $this->handleResponse($programmer['programmer']);
    }
}
