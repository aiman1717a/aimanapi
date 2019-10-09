<?php

namespace App\Http\Controllers\Api\v1;

use App\Attributes;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\MyResource;
use App\Listings;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributesController extends Controller
{
    public function store(Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
            ]);
            $product = Attributes::query()->create($validated_data);
            return new MyResource($product);
        } catch (\Exception $exception){
            return new MyResource(["error" => "Invalid Data"]);
        }
    }
    public function index() : MyResource
    {
        try{
            $attributes = Attributes::all();
            return new MyResource($attributes);
        } catch (\Exception $exception){
            return new MyResource(["error" => "Invalid Data"]);
        }
    }
    public function update($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'nullable|string',
            ]);
            $product = Attributes::query()->findOrFail($id);
            $product->name = $validated_data['name'];
            $product->saveOrFail();
            return new MyResource($product);
        } catch (\Exception | \Throwable $exception){
            return new MyResource(["error" => $exception->getMessage()]);
        }
    }
    public function destroy($id){
        $now = new DateTime();
        try {
            $attribute = Attributes::query()->findOrFail($id);
            if($attribute != null){
                $attribute->delete();
                $attribute->saveOrFail();
                $data =  array(
                    'id' => $attribute->id,
                    'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
                );
                return new MyResource($data);
            }
            return new MyResource(null);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource(["error" => "Product is not available to be deleted"]);
        }
    }
}
