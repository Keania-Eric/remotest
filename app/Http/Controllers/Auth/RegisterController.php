<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
        
    /**
     * Method register
     *
     * @param RegisterRequest $request [explicite description]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {

            $data = $request->getSanitized();
            
            $user = User::create($data);

            return $this->successResponse($user->toArray(), 'Accounted created successfully!', Response::HTTP_CREATED);

        }catch(ValidationException $error) {
            return $this->validationErrorResponse($error);
        }catch(\Exception $error) {
            return $this->serverErrorResponse($error);
        }
    }
}
