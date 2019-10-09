<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\OrderItems
 *
 * @property int $id
 * @property int $order_id
 * @property int $listing_id
 * @property float $price
 * @property int $quantity
 * @property int $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItems whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderItems extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'listing_id',
        'price',
        'quantity',
        'total',
    ];
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'listing_id' => 'integer',
        'price' => 'decimal',
        'quantity' => 'integer',
        'total' => 'decimal',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
