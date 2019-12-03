<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AttributesDateTimeValues
 *
 * @property int $id
 * @property int $attribute_id
 * @property int $listing_id
 * @property string $value
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesDateTimeValues onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AttributesDateTimeValues whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesDateTimeValues withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\AttributesDateTimeValues withoutTrashed()
 * @mixin \Eloquent
 */
class AttributesDateTimeValues extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'attributes_date_time_values';
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
