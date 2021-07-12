<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\DepartmentStoreRequest;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    //

    public function all(Request $request)
    {
        $departments = Department::all();

        return $this->successResponse($departments, 'Department List', Response::HTTP_OK);
    }


    public function create(DepartmentStoreRequest $request)
    {
        try {
            $data = $request->getSanitized();
            $dept  = Department::create($data);
            return $this->successResponse($data, 'Department was created successfully!', Response::HTTP_CREATED);

        }catch(ValidationException $error) {
            return $this->validationErrorResponse($error);
        }catch(\Exception $error) {
            return $this->serverErrorResponse($error);
        }
    }
}
