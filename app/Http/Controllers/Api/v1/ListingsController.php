<?php

namespace App\Http\Controllers\Api\v1;

use App\Categories;
use App\Employees;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\EmployeeResourceCollection;
use App\Http\Resources\v1\MyResource;
use App\Listings;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    /**
     * Create
     *
     * @param Request $request
     * @return MyResource
     */
    public function store(Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
                'showcase' => ['nullable', Rule::in(['Active', 'InActive']),],
            ]);
            $product = Listings::query()->create($validated_data);
            return new MyResource($product);
        } catch (\Exception $exception){
            return new MyResource(["error" => "Invalid Data"]);
        }
    }
    public function index() : MyResource
    {
        try{
            $product = Listings::all();
            return new MyResource($product);
        } catch (\Exception $exception){
            return new MyResource(["error" => "Invalid Data"]);
        }
    }
    public function paginate() : MyResource{
        return new MyResource(Listings::query()->paginate());
    }
    public function update($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'nullable|string',
                'price' => 'nullable|numeric',
                'description' => 'nullable|string',
                'has_attribute' => 'nullable|boolean',
                'have_tags' => 'nullable|boolean',
                'showcase' => ['nullable', Rule::in(['Active', 'InActive']),],
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->update($validated_data);
            return new MyResource($product);
        } catch (\Exception $exception){
            return new MyResource(["error" =>$exception->getMessage()]);
        }
    }
    public function updateName($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'nullable|string',
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->name = $validated_data['name'];
            $product->saveOrFail();
            return new MyResource($product);
        } catch (\Exception | \Throwable $exception){
            return new MyResource(["error" => $exception->getMessage()]);
        }
    }
    public function updatePrice($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'price' => 'required|numeric',
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->price = $validated_data['price'];
            $product->saveOrFail();
            return new MyResource($product);
        } catch (\Exception | \Throwable $exception){
            return new MyResource(["error" => $exception->getMessage()]);
        }
    }
    public function updateDescription($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'description' => 'required|string',
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->description = $validated_data['description'];
            $product->saveOrFail();
            return new MyResource($product);
        } catch (\Exception | \Throwable $exception){
            return new MyResource(["error" => $exception->getMessage()]);
        }
    }
    public function destroy($id){
        $now = new DateTime();
        try {
            $product = Listings::query()->findOrFail($id);
            if($product != null){
                $product->delete();
                $product->saveOrFail();
                $data =  array(
                    'id' => $product->id,
                    'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
                );
                return new MyResource($data);
            }
            return new MyResource(null);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource(["error" => "Product is not available to be deleted"]);
        }
    }
    public function destroyAll(){
        $now = new DateTime();
        try {
            $products = Listings::all();
            if($products != null){
                $data = array();
                foreach ($products as $product){
                    $product->delete();
                    $product->saveOrFail();
                    $row =  array(
                        'id' => $product->id,
                        'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
                    );
                    $data[] = $row;
                }
                return new MyResource($data);
            }
            return new MyResource(null);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource(["error" => "All Products could not be deleted"]);
        }
    }
}
