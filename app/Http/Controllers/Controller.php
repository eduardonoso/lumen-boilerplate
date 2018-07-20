<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $request;
    protected $headers;
    protected $response = [];
    protected $errors = [];
    protected $code = 422;

    public function __construct(Request $request)
    {
        $this->headers = $request->headers->all();
        $this->request = $request->all();

//        $this->middleware('auth', ['only' => ['get','post','put','delete']]);
    }

    public function respond($response = null, $code = null){
        if(count($this->errors) > 0){
            $this->response['errors'] = $this->errors;
        } else {
            if($response !== null){
                $this->response = $response;
            }
            if($code !== null){
                $this->code = $code;
            }
            $this->response['code'] = $this->code;
        }
        return response()->json($this->response, $this->code);
    }

    public function setResponse($response, $code = null){
        $this->response = $response;
        if($code){
            $this->code = $code;
        }
    }

    public function setErrors($errors, $code = null){
        $this->errors = $errors;
        if($code){
            $this->code = $code;
        }
    }

    public function addError($error){
        $this->errors[] = $error;
    }

    public function httpCode($code){
        $this->code = $code;
    }

    public function serverError(){
        $this->errors = ['Server Error'];
        $this->code = 500;
    }

    public function validateRequest(Request $request, $rules){
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validatorErrors = $validator->errors()->toArray();
            $errors          = [];
            foreach ($validatorErrors as $errorName => $errorValue) {
                $readableError = str_replace('.', ' ', $errorValue);
                array_set($errors, $errorName, $readableError);
            }
            Controller::setErrors($errors, HttpCode::UNPROCESSABLE_ENTITY);
            return false;
        }
        return true;
    }
}
