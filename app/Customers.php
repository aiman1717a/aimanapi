<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Customers
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Customers onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customers withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Customers withoutTrashed()
 * @mixin \Eloquent
 */
class Customers extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
    ];
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
