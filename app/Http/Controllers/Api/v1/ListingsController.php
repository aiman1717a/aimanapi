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
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use App\CustomClass\Error;

class ListingsController extends Controller
{
    private $error_class = null;
    function __construct(){
        $this->error_class = new Error();
    }
    public function store(Request $request): MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'category_id' => 'required|numeric',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
                'image' => 'required|string',
                'status' => ['nullable', Rule::in(['Active', 'InActive']),],
            ]);
            $product = Listings::query()->create($validated_data);
            return new MyResource($product);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printCreateError()
                ]
            );
        }
    }
    public function getListings(): MyResource
    {
        try{
            $limit = \request()->get('limit', 10);
            $product = Listings::take($limit)->get();
            return new MyResource($product);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printReadError()
                ]
            );
        }
    }
    public function getListingsByIds(Request $request)
    {
        try{
            $validated_data = $this->validate($request, [
                'id' => 'required|array',
//                'id.*'  => 'required|numeric',
            ]);
           $listings = null;
            for ($i = 1; $i <= count($validated_data['id']); $i++){
                $listing = Listings::whereId($validated_data['id'][$i-1])->firstOrFail();;
                $listings[] = $listing;
            }
            return new MyResource($listings);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printReadError()
                ]
            );
        }
    }
    public function getListingById($id) : MyResource
    {
        try{
            $listing = Listings::whereId($id)->firstOrFail();
            return new MyResource($listing);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                    "error" => $this->error_class->printReadError()
                ]
            );
        }

    }
    public function paginate() : MyResource{
        return new MyResource(Listings::query()->paginate());
    }
    public function update($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'category_id' => 'required|numeric',
                'name' => 'nullable|string',
                'price' => 'nullable|numeric',
                'description' => 'nullable|string',
                'image' => 'required|string',
                'status' => ['nullable', Rule::in(['Active', 'InActive']),],
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->update($validated_data);
            return new MyResource($product);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printUpdateError()
                ]
            );
        }
    }
    public function updateName($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->name = $validated_data['name'];
            $product->saveOrFail();
            return new MyResource($product);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                    "error" => $this->error_class->printUpdateError()
                ]
            );
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
            return new MyResource([
                    "error" => $this->error_class->printUpdateError()
                ]
            );
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
            return new MyResource([
                    "error" => $this->error_class->printUpdateError()
                ]
            );
        }
    }
    public function updateImage($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'image' => 'required|string',
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->image = $validated_data['image'];
            $product->saveOrFail();
            return new MyResource($product);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                    "error" => $this->error_class->printUpdateError()
                ]
            );
        }
    }
    public function updateStatus($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'status' => 'required|string',
            ]);
            $product = Listings::query()->findOrFail($id);
            $product->status = $validated_data['status'];
            $product->saveOrFail();
            return new MyResource($product);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                    "error" => $this->error_class->printUpdateError()
                ]
            );
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
            return new MyResource([
                    "error" => $this->error_class->printDeleteError()
                ]
            );
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
            return new MyResource([
                    "error" => $this->error_class->printDeleteError()
                ]
            );
        }
    }
}
