<?php

namespace App\Http\Controllers\Api\v1;

use App\Categories;
use App\Employees;
use App\Http\Resources\v1\MyResource;
use App\Http\Resources\v1\EmployeeResourceCollection;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    public function login(Request $request){
        try{
            $validated_data = $this->validate($request, [
                'email' => 'required|email:rfc,dns|unique:admin,email',
                'password' => 'required|string',
            ]);
            $admin = Employees::whereName($validated_data['name'])
                ->where('password', $validated_data['password'])
                ->where('status', 'Active')
                ->firstOrFail();
            return new MyResource($admin);
        } catch (\Exception $exception) {
            return new MyResource([
                "error" => "Login Failed"
            ]);
        }
    }
    public function register(Request $request) : MyResource{
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
                'password' => 'required|string',
                'email' => 'required|email:rfc,dns|unique:admin,email',
                'type' => ['required', Rule::in(['Admin', 'Editors', 'Moderators']),],
                'status' => ['required', Rule::in(['Active', 'InActive']),],
            ]);
            $employee = Employees::query()->create($validated_data);
            return new MyResource($employee);
        } catch (\Exception $exception){
            return new MyResource([
                "error" => "Registration Failed"
            ]);
        }
    }
    public function getEmployees() : MyResource{
        try{
            $employees = Employees::all();
            return new MyResource($employees);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function getEmployeeById($id) : MyResource{
        try{
            $employee = Employees::whereId($id)->firstOrFail();
            return new MyResource($employee);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function getEmployeesByType($type) : MyResource{
        try{
            $employee = Employees::whereType($type)->get();
            return new MyResource($employee);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function update($id, Request $request){
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
                'password' => 'required|string',
                'email' => 'required|string',
                'type' => 'nullable|string',
                'status' => 'nullable|string',
            ]);
            $employee = Employees::findOrFail($id);
            $employee->update($validated_data);
            $employee->saveOrFail();
            $data =  array(
                'name' => $employee->name,
                'password' => $employee->password,
                'email' => $employee->email,
                'status' => $employee->status,
                'updated_at' => $employee->updated_at,
            );
            return new MyResource($data);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                'error' => 'Update Failed'
            ]);
        }
    }
    public function updateName($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
            ]);
            $employee = Employees::query()->findOrFail($id);
            $employee->name = $validated_data['name'];
            $employee->saveOrFail();
            return new MyResource($employee);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                'error' => 'Name could not be updated'
            ]);
        }
    }
    public function updatePassword($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'password' => 'required|string',
            ]);
            $employee = Employees::query()->findOrFail($id);
            $employee->password = $validated_data['password'];
            $employee->saveOrFail();
            return new MyResource($employee);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                'error' => 'Password could not be updated'
            ]);
        }
    }
    public function updateEmail($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'email' => 'required|string',
            ]);
            $employee = Employees::query()->findOrFail($id);
            $employee->email = $validated_data['email'];
            $employee->saveOrFail();
            return new MyResource($employee);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                'error' => 'Email could not be updated'
            ]);
        }
    }
    public function updateType($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'type' => 'required|string',
            ]);
            $employee = Employees::query()->findOrFail($id);
            $employee->type = $validated_data['type'];
            $employee->saveOrFail();
            return new MyResource($employee);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                'error' => 'type could not be updated'
            ]);
        }
    }
    public function updateStatus($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'status' => 'required|string',
            ]);
            $employee = Employees::query()->findOrFail($id);
            $employee->status = $validated_data['status'];
            $employee->saveOrFail();
            return new MyResource($employee);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                'error' => 'Status could not be updated'
            ]);
        }
    }
    public function destroy($id)
    {
        $now = new DateTime();
        try {
            $employee = Employees::query()->find($id);
            $employee->delete();
            $data =  array(
                'id' => $employee->id,
                'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
            );
            return new MyResource($data);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource([
                "error" => 'Employee not found'
            ]);
        }
    }
    public function destroyAll()
    {
        $now = new DateTime();
        try {
            $data = array();
            $employees = Categories::all();
            if(sizeof($employees) !== 0){
                foreach ($employees as $employee){
                    $employee->delete();
                    $data[] =  array(
                        'id' => $employee->id,
                        'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
                    );
                }
                return new MyResource($data);
            }
            return new MyResource([
                "error" => 'Employees not found'
            ]);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource([
                "error" => $exception->getMessage()
            ]);
        }
    }
}
