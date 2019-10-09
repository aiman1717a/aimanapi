<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;
use phpseclib\Math\BigInteger;



/**
 * App\Stocks
 *
 * @property int $id
 * @property int $listing_id
 * @property int $quantity
 * @property int $quantity_per_unit
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Listings $stocks
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Stocks onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks whereQuantityPerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stocks whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stocks withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Stocks withoutTrashed()
 * @mixin \Eloquent
 */
class Stocks extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'stocks';
    protected $fillable = [
        'listing_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'listing_id' => 'integer',
        'quantity' => 'integer',
        'quantity_per_unit' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;

    public function stocks()
    {
        return $this->belongsTo(Listings::class);
    }
}
