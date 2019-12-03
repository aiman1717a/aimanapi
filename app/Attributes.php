<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Attributes
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Attributes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attributes withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Attributes withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attributes whereDeletedAt($value)
 */
class Attributes extends Model
{

    protected $connection = 'masterkids_db';
    protected $table = 'attributes';
    protected $fillable = [
        'name',
    ];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
