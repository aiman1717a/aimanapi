<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Listings
 *
 * @property int $id
 * @property int $name
 * @property mixed $price
 * @property string|null $description
 * @property string $status
 * @property int|null $category_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Stocks $stocks
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Listings onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Listings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Listings withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Listings withoutTrashed()
 * @mixin \Eloquent
 */
class Listings extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'listings';
    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
    ];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'float',
        'description' => 'string',
        'status' => 'string',
        'category_id' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;

    public function stocks()
    {
        return $this->hasOne(Stocks::class);
    }
}
