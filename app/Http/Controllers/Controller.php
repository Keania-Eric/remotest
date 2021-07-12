<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /*** Just adding base methods to make responses easier */
        
    /**
     * Method successResponse
     *
     * @param array $data [Any data needed to be returned]
     * @param string $msg [Message needed to be seent to user]
     * @param int $code [Http status code might vary when successful]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $msg, $code)
    {
        return response()->json(['status'=>1, 'data'=> $data, 'msg'=>$msg], $code);
    }

    
    /**
     * Method validationErrorResponse
     *
     * @param \Exception $error [error thrown]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationErrorResponse($error)
    {
        return response()->json(['status'=>0, 'msg'=> json_encode($error->errors())], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    
    /**
     * Method serverErrorResponse
     *
     * @param \Exception $error [error thrown]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function serverErrorResponse($error)
    {
        return response()->json(['status'=>0, 'msg'=> $error->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
