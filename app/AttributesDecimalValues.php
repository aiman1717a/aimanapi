<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AttributesDecimalValues
 *
 * @property int $id
 * @property int $attribute_id
 * @property int $listing_id
 * @property float $value
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesDecimalValues onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDecimalValues whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesDecimalValues withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesDecimalValues withoutTrashed()
 * @mixin \Eloquent
 */
class AttributesDecimalValues extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'attributes_decimal_values';
    protected $fillable = [
        'attribute_id',
        'listing_id',
        'value',
    ];
    protected $casts = [
        'id' => 'integer',
        'attribute_id' => 'integer',
        'listing_id' => 'integer',
        'value' => 'float',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
