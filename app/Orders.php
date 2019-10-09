<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;




/**
 * App\Orders
 *
 * @property int $id
 * @property int $customer_id
 * @property string $status
 * @property string $ordered_on
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Orders onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders whereOrderedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Orders withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Orders withoutTrashed()
 * @mixin \Eloquent
 */
class Orders extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'status',
        'ordered_on',
    ];
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'status' => 'string',
        'ordered_on' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
