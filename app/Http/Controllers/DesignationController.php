<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\DesignationStoreRequest;

class DesignationController extends Controller
{
    //
    public function all(Request $request)
    {
        $designations = Designation::all();

        return $this->successResponse($designations, 'Designation List', Response::HTTP_OK);
    }


    public function create(DesignationStoreRequest $request)
    {
        try {
            $data = $request->getSanitized();
            $dept  = Designation::create($data);
            return $this->successResponse($data, 'Designation was created successfully!', Response::HTTP_CREATED);

        }catch(ValidationException $error) {
            return $this->validationErrorResponse($error);
        }catch(\Exception $error) {
            return $this->serverErrorResponse($error);
        }
    }
}
