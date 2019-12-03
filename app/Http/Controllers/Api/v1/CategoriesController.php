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
    private $validation_rules = null;

    function __construct()
    {
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
            "delete" => array(
                "error" => "could not be Deleted"
            )
        );
        $this->validation_rules = array(
            "id" => 'required|numeric|max:20',
            "code" => 'required|string|max:50',
            "slug" => 'required|string|max:100',
            "name" => 'required|string|max:100',
            "description" => 'nullable|string|max:200',
        );
    }

    public function store(Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'code' => $this->validation_rules['code'],
                'slug' => $this->validation_rules['slug'],
                'name' => $this->validation_rules['name'],
                'description' => $this->validation_rules['description'],
            ]);
            $category = Categories::query()->create($validated_data);
            return new MyResource($category);
        } catch (\Exception $exception){
            return new MyResource($this->my_error['create']);
        }
    }

    public function getCategories() : MyResource
    {
        try{
            $categories = Categories::all();
            return new MyResource($categories);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getCategoryById($id) : MyResource
    {
        try{
            $category = Categories::whereId($id)->first();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getCategoryByCode($code) : MyResource
    {
        try{
            $category = Categories::whereCode($code)->first();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $validated_data = $this->validate($request, [
                'code' => $this->validation_rules['code'],
                'slug' => $this->validation_rules['slug'],
                'name' => $this->validation_rules['name'],
                'description' => $this->validation_rules['description'],
            ]);
            $category = Categories::findOrFail($id);
            $category->update($validated_data);
            $category->saveOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['update']);
        }
    }
    public function updateCode($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'code' => $this->validation_rules['code']
            ]);
            $category = Categories::query()->findOrFail($id);
            $category->code = $validated_data['code'];
            $category->saveOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['update']);
        }
    }
    public function updateName($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => $this->validation_rules['name']
            ]);
            $category = Categories::query()->findOrFail($id);
            $category->name = $validated_data['name'];
            $category->saveOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['update']);
        }
    }
    public function updateDescription($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'description' => $this->validation_rules['description']
            ]);
            $category = Categories::query()->findOrFail($id);
            $category->description = $validated_data['description'];
            $category->saveOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['update']);
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
