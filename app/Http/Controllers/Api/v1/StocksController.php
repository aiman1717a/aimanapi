<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\MyResource;
use App\Stocks;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StocksController extends Controller
{
    public function store(Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'listing_id' => 'required|numeric',
                'quantity' => 'required|numeric',
                'quantity_per_unit' => 'nullable|numeric',
            ]);
            $stock = Stocks::query()->create($validated_data);
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource(["error" => $exception->getMessage()]);
        }
    }
    public function getAllStock() : MyResource
    {
        try{
            $stocks = Stocks::all();
            return new MyResource($stocks);
        } catch (\Exception $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function getStockById($id) : MyResource
    {
        try{
            $stock = Stocks::whereId($id)->firstOrFail();
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function getStockByListingId($id) : MyResource
    {
        try{
            $stock = Stocks::whereListingId($id)->firstOrFail();
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource([
                "error" => "Invalid Data"
            ]);
        }
    }
    public function update($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'listing_id' => 'required|numeric',
                'available_quantity' => 'required|numeric',
                'per_unit_qty' => 'nullable|numeric',
            ]);
            $stock = Stocks::query()->findOrFail($id);
            $stock->update($validated_data);
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" =>$exception->getMessage()
            ]);
        }
    }
    public function updateQuantity($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'quantity' => 'required|numeric',
            ]);
            $stock = Stocks::query()->findOrFail($id);
            $stock->quantity = $validated_data['quantity'];
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => $exception->getMessage()
            ]);
        }
    }
    public function updateQuantityPerUnit($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'quantity_per_unit' => 'required|numeric',
            ]);
            $stock = Stocks::query()->findOrFail($id);
            $stock->quantity_per_unit = $validated_data['quantity_per_unit'];
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => $exception->getMessage()
            ]);
        }
    }
    public function updateQuantityByListingId($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'quantity' => 'required|string',
            ]);
            $stock = Stocks::query()->findOrFail($id, 'listing_id');
            $stock->quantity = $validated_data['quantity'];
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => $exception->getMessage()
            ]);
        }
    }
    public function updateQuantityPerUnitByListingId($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'quantity_per_unit' => 'required|numeric',
            ]);
            $stock = Stocks::query()->findOrFail($id, 'listing_id');
            $stock->quantity_per_unit = $validated_data['quantity_per_unit'];
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                "error" => $exception->getMessage()
            ]);
        }
    }
    public function destroy($id){
        $now = new DateTime();
        try {
            $stock = Stocks::query()->findOrFail($id);
            if($stock != null){
                $stock->delete();
                $stock->saveOrFail();
                $data =  array(
                    'id' => $stock->id,
                    'deleted_at' =>  $now->getTimestamp()
                );
                return new MyResource($data);
            }
            return new MyResource(null);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource(["error" => "Product is not available to be deleted"]);
        }
    }
    public function destroyByListingId($id){
        $now = new DateTime();
        try {
            $stock = Stocks::whereListingId($id)->firstOrFail();
            if($stock != null){
                $stock->delete();
                $stock->saveOrFail();
                $data =  array(
                    'id' => $stock->id,
                    'deleted_at' =>  $now->getTimestamp()
                );
                return new MyResource($data);
            }
            return new MyResource(null);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource(["error" => "Product is not available to be deleted"]);
        }
    }
}
