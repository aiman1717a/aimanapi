<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AttributesVarcharValues
 *
 * @property int $id
 * @property int $attribute_id
 * @property int $listing_id
 * @property string $value
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesVarcharValues onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesVarcharValues whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesVarcharValues withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesVarcharValues withoutTrashed()
 * @mixin \Eloquent
 */
class AttributesVarcharValues extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'attributes_varchar_values';
    protected $fillable = [
        'attribute_id',
        'listing_id',
        'value',
    ];
    protected $casts = [
        'id' => 'integer',
        'attribute_id' => 'integer',
        'listing_id' => 'integer',
        'value' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
