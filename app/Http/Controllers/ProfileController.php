<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    /**
     * Method update
     *
     * @param UpdateProfileRequest $request [explicite description]
     *
     * @return void
     */
    public function update(UpdateProfileRequest $request)
    {
        
        try {

            $data = $request->getSanitized();
            $data['user_id'] = $request->user()->id;
            $employee = Employee::firstOrCreate($data);

            return $this->successResponse($employee->toArray(), 'Profile Updated Successfully!', Response::HTTP_CREATED);

        }catch(ValidationException $error) {
            return $this->validationErrorResponse($error);
        }catch(\Exception $error) {
            return $this->serverErrorResponse($error);
        }

    }
}
