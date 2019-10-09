<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Deliveries
 *
 * @property int $id
 * @property int $customer_id
 * @property string $name
 * @property string $street
 * @property string $state
 * @property string $city
 * @property string $island
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Deliveries onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereIsland($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deliveries whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Deliveries withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Deliveries withoutTrashed()
 * @mixin \Eloquent
 */
class Deliveries extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'deliveries';
    protected $fillable = [
        'customer_id',
        'name',
        '$street',
        '$state',
        '$city',
        '$island',
    ];
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'name' => 'string',
        '$street' => 'string',
        '$city' => 'string',
        '$island' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
