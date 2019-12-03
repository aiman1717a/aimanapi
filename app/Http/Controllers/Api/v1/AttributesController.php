<?php

namespace App\Http\Controllers\Api\v1;

use App\Attributes;
use App\AttributesDateTimeValues;
use App\AttributesDecimalValues;
use App\AttributesIntValues;
use App\AttributesVarcharValues;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\MyResource;
use App\Listings;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributesController extends Controller
{
    private $my_error = "";

    function __construct()
    {
        $this->my_error = array(
            "create" => array(
                "error" => "Attribute not created"
            ),
            "read" => array(
                "error" => "Data Not Found"
            ),
            "update" => array(
                "error" => "Update Failed"
            ),
            "delete" => array(
                "error" => "Data deleted"
            )
        );
    }

    public function store(Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'listing_id' => 'required|numeric',
                'name' => 'required|string',
                'value' => 'required|string',
                'datatype' => 'required|numeric'
            ]);
            $attribute = Attributes::create([
                'name' => $validated_data['name']
            ]);
            switch ($validated_data['datatype']) {
                case 1:
                    $value = AttributesDateTimeValues::query()->create([
                        'attribute_id' => $attribute['id'],
                        'listing_id' => $validated_data['listing_id'],
                        'value' => $validated_data['value']
                    ]);
                    break;

                case 2:
                    $value = AttributesDecimalValues::query()->create([
                        'attribute_id' => $attribute['id'],
                        'listing_id' => $validated_data['listing_id'],
                        'value' => $validated_data['value']
                    ]);
                    break;

                case 3:
                    $value = AttributesIntValues::query()->create([
                        'attribute_id' => $attribute['id'],
                        'listing_id' => $validated_data['listing_id'],
                        'value' => $validated_data['value']
                    ]);
                    break;

                case 4:
                    $value = AttributesVarcharValues::query()->create([
                        'attribute_id' => $attribute['id'],
                        'listing_id' => $validated_data['listing_id'],
                        'value' => $validated_data['value']
                    ]);
                    break;

                default:
                    # code...
                    break;
            }
            return new MyResource(['status' => 'Fucking Success']);
        } catch (\Exception $exception){
            // return new MyResource($this->my_error['create']);
            return new MyResource(['error' => $exception->getMessage()]);
        }
    }
    public function getAttributes() : MyResource
    {
        try{
            $attributes = Attributes::all();
            return new MyResource($attributes);
        } catch (\Exception $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getAttributeById($id) : MyResource
    {
        try{
            $attribute = Attributes::whereId($id)->firstOrFail();
            return new MyResource($attribute);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function getAttributeByName($name) : MyResource
    {
        try{
            $attribute = Attributes::query()->where('name', $name)->firstOrFail();
            return new MyResource($attribute);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['read']);
        }
    }
    public function updateAttributeName($attribute_id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'name' => 'required|string',
            ]);
            $attribute = Attributes::query()->findOrFail($attribute_id);
            $attribute->update($validated_data);
            $attribute->saveOrFail();
            return new MyResource($attribute);
        } catch (\Exception | \Throwable $exception){
            return new MyResource(['error' => $exception->getMessage()]);
        }
    }
    public function updateAttributeValue($value_id, Request $request) : MyResource
    {
        try{
            $validated_data = $this->validate($request, [
                'value' => 'string',
                'datatype' => 'required|numeric'
            ]);
            $attributeValue = null;
            switch ($validated_data['datatype']) {
                case 1:
                    $attributeValue = AttributesDateTimeValues::query()->findOrFail($value_id);
                    break;

                case 2:
                    $attributeValue = AttributesDecimalValues::query()->findOrFail($value_id);
                    break;

                case 3:
                    $attributeValue = AttributesIntValues::query()->findOrFail($value_id);
                    break;

                case 4:
                    $attributeValue = AttributesVarcharValues::query()->findOrFail($value_id);
                    break;

                default:
                    # code...
                    break;
            }
            $attributeValue->update([
                'value' => $validated_data['value']
            ]);
            $attributeValue->saveOrFail();
            return new MyResource($attributeValue);
        } catch (\Exception | \Throwable $exception){
            return new MyResource($this->my_error['update']);
        }

    }
    public function destroy($id){
        $now = new DateTime();
        try {
            $attribute = Attributes::query()->findOrFail($id);
            $attribute->delete();
            $attribute->saveOrFail();
            $attribute =  array(
                'id' => $attribute->id,
                'deleted_at' =>  $now->getTimestamp()
            );
            return new MyResource($attribute);
        } catch (\Exception | \Throwable $exception) {
            return new MyResource($this->my_error['delete']);
        }
    }
}
