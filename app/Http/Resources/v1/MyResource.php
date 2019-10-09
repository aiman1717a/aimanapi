<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class MyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $json = parent::toArray($request);
        return [
            'success' => array_key_exists('error', $json) !== true ? true : false,
            'is_null' => empty($json) ? true : false,
            'requested_at' => date("d F Y, h:i:s A", time()),
            'data' => $json,
            'api' => 'masterkids',
            'api version' => 'v1',
        ];
    }

    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
