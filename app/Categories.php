<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Categories
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Categories onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Categories whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Categories withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Categories withoutTrashed()
 * @mixin \Eloquent
 */
class Categories extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'categories';
    protected $fillable = [
        'code',
        'name',
        'description',
    ];
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
