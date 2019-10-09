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
    public function store(Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'code' => 'required|string',
                'name' => 'required|string',
                'description' => 'nullable|string',
            ]);
            $category = Categories::query()->create($validated_data);
            return new MyResource($category);
        } catch (\Exception $exception){
            return new MyResource([
                "error" => $exception->getMessage()
            ]);
        }
    }
    public function getCategories() : MyResource
    {
        try{
            $categories = Categories::all();
            return new MyResource($categories);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function getCategoryById($id) : MyResource
    {
        try{
            $category = Categories::whereId($id)->firstOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }

    }
    public function getCategoryByCode($code) : MyResource
    {
        try{
            $category = Categories::whereCode($code)->firstOrFail();
            return new MyResource($category);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function update(Request $request, $id)
    {
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
            return new MyResource([
                'error' => 'Update Failed'
            ]);
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
            return new MyResource([
                'error' => 'Code could not be updated'
            ]);
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
            return new MyResource([
                'error' => 'Name could not be updated'
            ]);
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
            return new MyResource([
                'error' => 'Description could not be updated'
            ]);
        }
    }
    public function destroy($id)
    {
        $now = new DateTime();
        try {
            $category = Categories::query()->find($id);
            $category->delete();
            $data =  array(
                'id' => $category->id,
                'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
            );
            return new MyResource($data);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource([
                "error" => 'Category not found'
            ]);
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
                    $data[] =  array(
                        'id' => $category->id,
                        'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
                    );
                }
                return new MyResource($data);
            }
            return new MyResource([
                "error" => 'Categories not found'
            ]);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource([
                "error" => $exception->getMessage()
            ]);
        }
    }
}
