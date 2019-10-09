<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Employees
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $email
 * @property string $type
 * @property string $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Employees onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employees whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Employees withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Employees withoutTrashed()
 * @mixin \Eloquent
 */
class Employees extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'password',
        'email',
        'type',
        'status',
    ];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'type' => 'string',
        'status' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
