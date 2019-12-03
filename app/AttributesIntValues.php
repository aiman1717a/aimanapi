<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AttributesIntValues
 *
 * @property int $id
 * @property int $attribute_id
 * @property int $listing_id
 * @property int $value
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesIntValues onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesIntValues whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesIntValues withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesIntValues withoutTrashed()
 * @mixin \Eloquent
 */
class AttributesIntValues extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'attributes_int_values';
    protected $fillable = [
        'attribute_id',
        'listing_id',
        'value',
    ];
    protected $casts = [
        'id' => 'integer',
        'attribute_id' => 'integer',
        'listing_id' => 'integer',
        'value' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
