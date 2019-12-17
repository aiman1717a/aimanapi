<?php

namespace App\Http\Controllers\Api\v1;

use App\Categories;
use App\CustomClass\Error;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\MyResource;
use App\Stocks;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StocksController extends Controller
{
    private $error_class = null;
    function __construct()
    {
        $this->error_class = new Error();
    }
    public function store(Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'listing_id' => 'required|numeric',
                'quantity' => 'required|numeric',
            ]);
            $stock = Stocks::query()->create($validated_data);
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printCreateError()
                ]
            );
        }
    }
    public function getStocks() : MyResource
    {
        try{
            $stocks = Stocks::all();
            return new MyResource($stocks);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printReadError()
                ]
            );
        }
    }
    public function getStockById($id) : MyResource
    {
        try{
            $stock = Stocks::whereId($id)->firstOrFail();
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printReadError()
                ]
            );
        }
    }
    public function getStockByListingId($id) : MyResource
    {
        try{
            $stock = Stocks::whereListingId($id)->firstOrFail();
            return new MyResource($stock);
        } catch (\Exception $exception){
            return new MyResource([
                    "error" => $this->error_class->printReadError()
                ]
            );
        }
    }
    public function update($id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'listing_id' => 'required|numeric',
                'quantity' => 'required|numeric',
            ]);
            $stock = Stocks::query()->findOrFail($id);
            $stock->update($validated_data);
            $stock->saveOrFail();
            return new MyResource($stock);
        } catch (\Exception | \Throwable $exception){
            return new MyResource([
                    "error" => $this->error_class->printUpdateError()
                ]
            );
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
                    "error" => $this->error_class->printUpdateError()
                ]
            );;
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
                    "error" => $this->error_class->printUpdateError()
                ]
            );
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
            return new MyResource([
                    "error" => $this->error_class->printDeleteError()
                ]
            );
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
            return new MyResource([
                    "error" => $this->error_class->printDeleteError()
                ]
            );
        }
    }
    public function destroyAll()
    {
        $now = new DateTime();
        try {
            $data = array();
            $stocks = Stocks::all();
            if(sizeof($stocks) !== 0){
                foreach ($stocks as $stock){
                    $stock->delete();
                    $stock->saveOrFail();
                    $data[] =  array(
                        'id' => $stock->id,
                        'deleted_at' => date("d F Y, h:i:s A", $now->getTimestamp())
                    );
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
