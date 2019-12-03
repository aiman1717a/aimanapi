<?php

namespace App\Http\Controllers\Api\v1;

use App\Categories;
use App\Http\Resources\v1\MyResource;
use App\Stocks;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    private $my_error = "";

    function __construct()
    {
        global $my_error;
        $this->my_error = array(
            "create" => array(
                "error" => "Data Creation Failed"
            ),
            "read" => array(
                "error" => "Invalid Data"
            ),
            "update" => array(
                "error" => "Update Failed"
            ),
            "update2" => array(
                "error" => "not be Updated"
            ),
            "delete" => array(
                "error" => "could not be Deleted"
            )
        );
    }

    public function store(Request $request) : MyResource
    {
        global $my_error;
        try{
            $validated_data = $this->validate($request, [
                'code' => 'required|string',
                'slug' => 'required|string',
                'name' => 'required|string',
                'description' => 'nullable|string',
            ]);
            $category = Categories::query()->create($validated_data);
            return new MyResource($category);
        } catch (\Exception $exception){
            return new MyResource(['error' => $exception->getMessage()]);
        }
    }
    public function getCategories() : MyResource
    {
        global $my_error;
        try{
            $categories = Categories::all();
            return new MyResource($categories);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getCategoryById($id)
    {
        global $my_error;
        try{
            $category = Categories::whereId($id)->firstOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getCategoryByCode($code) : MyResource
    {
        global $my_error;
        try{
            $category = Categories::whereCode($code)->firstOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function update(Request $request, $id)
    {
        global $my_error;
        try{
            $validated_data = $this->validate($request, [
                'code' => 'required|string',
                'name' => 'required|string',
                'description' => 'nullable|string',
            ]);
            $category = Categories::findOrFail($id);
            $category->update($validated_data);
            $category->saveOrFail();
            $data =  array(
                'code' => $category->code,
                'name' => $category->name,
                'description' => $category->description,
                'updated_at' => $category->updated_at,
            );
            return new MyResource($data);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['update']);
        }
    }
    public function updateCode($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'code' => 'required|string',
            ]);
            $category = Categories::query()->findOrFail($id);
            $category->code = $validated_data['code'];
            $category->saveOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource('Code' . $this->my_error['update2']);
        }
    }
    public function updateName($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
            ]);
            $category = Categories::query()->findOrFail($id);
            $category->name = $validated_data['name'];
            $category->saveOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource('Name' . $this->my_error['update2']);
        }
    }
    public function updateDescription($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'description' => 'required|string',
            ]);
            $category = Categories::query()->findOrFail($id);
            $category->description = $validated_data['description'];
            $category->saveOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource('Description' . $this->my_error['update2']);
        }
    }
    public function destroy($id)
    {
        $now = new DateTime();
        try {
            $category = Categories::query()->findOrFail($id);
            $category->delete();
            $category->saveOrFail();
            $data =  array(
                'id' => $category->id,
                'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
            );
            return new MyResource($data);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource('Category'. $this->my_error['delete']);
        }
    }
    public function destroyAll()
    {
        $now = new DateTime();
        try {
            $data = array();
            $categories = Categories::all();
            if(sizeof($categories) !== 0){
                foreach ($categories as $category){
                    $category->delete();
                    $category->saveOrFail();
                    $data[] =  array(
                        'id' => $category->id,
                        'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
                    );
                }
                return new MyResource($data);
            }
            return new MyResource(null);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource('Categories'. $this->my_error['delete']);
        }
    }
}
