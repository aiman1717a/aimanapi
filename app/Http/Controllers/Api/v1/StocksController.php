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
                'listing_id' => 'required|numeric',
                'quantity' => 'required|numeric',
                'quantity_per_unit' => 'nullable|numeric',
            ]);
            $stock = Stocks::query()->create($validated_data);
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource($this->my_error['create']);
        }
    }
    public function getStocks() : MyResource
    {
        global $my_error;
        try{
            $stocks = Stocks::all();
            return new MyResource($stocks);
        } catch (\Exception $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getStockById($id) : MyResource
    {
        global $my_error;
        try{
            $stock = Stocks::whereId($id)->firstOrFail();
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getStockByListingId($id) : MyResource
    {
        global $my_error;
        try{
            $stock = Stocks::whereListingId($id)->firstOrFail();
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function update($id, Request $request) : MyResource
    {
        global $my_error;
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
            return new MyResource($this->my_error['update']);
        }
    }
    public function updateQuantity($id, Request $request) : MyResource
    {
        global $my_error;
        try{
            $validated_data = $this->validate($request, [
                'quantity' => 'required|numeric',
            ]);
            $stock = Stocks::query()->findOrFail($id);
            $stock->quantity = $validated_data['quantity'];
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
           return new MyResource('Quantity' . $this->my_error['update']);
        }
    }
    public function updateQuantityByListingId($id, Request $request) : MyResource
    {
        global $my_error;
        try{
            $validated_data = $this->validate($request, [
                'quantity' => 'required|string',
            ]);
            $stock = Stocks::query()->findOrFail($id, 'listing_id');
            $stock->quantity = $validated_data['quantity'];
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
            return new MyResource('Quantity' . $this->my_error['update']);
        }
    }
    public function destroy($id){
        global $my_error;
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
            return new MyResource('Stock' . $this->my_error['delete']);
        }
    }
    public function destroyByListingId($id){
        global $my_error;
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
            return new MyResource('Stock' . $this->my_error['delete']);
        }
    }
}
