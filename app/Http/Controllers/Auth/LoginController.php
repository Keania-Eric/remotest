<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    
    /**
     * Method login
     *
     * @param LoginRequest $request [explicite description]
     *
     * @return void
     */
    public function login(LoginRequest $request)
    {
        try {

            $data = $request->getSanitized();
            
            $user = User::where('email', $data['email'])->first();

            if (! $user || ! Hash::check($data['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken('Authentication')->plainTextToken;
            
            $data = ['token'=> $token];

            return $this->successResponse($data, 'Login was successful!', Response::HTTP_OK);

        }catch(ValidationException $error) {
            return $this->validationErrorResponse($error);
        }catch(\Exception $error) {
            return $this->serverErrorResponse($error);
        }
        
    }

    public function logout(Request $request)
    {
        
    }
}
