<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;




/**
 * App\Logs
 *
 * @property int $id
 * @property int $employee_id
 * @property string $action
 * @property int|null $created_at
 * @property int|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Logs onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Logs withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Logs withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logs whereDeletedAt($value)
 */
class Logs extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'logs';
    protected $fillable = [
        'employee_id',
        'action',
    ];
    protected $casts = [
        'id' => 'integer',
        'employee_id' => 'integer',
        'action' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
