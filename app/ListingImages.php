<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\ListingImages
 *
 * @property int $id
 * @property int $listing_id
 * @property string $image
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ListingImages onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ListingImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ListingImages withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ListingImages withoutTrashed()
 * @mixin \Eloquent
 */
class ListingImages extends Model
{
    protected $connection = 'masterkids_db';
    protected $table = 'listing_images';
    protected $fillable = [
        'listing_id',
        'image',
    ];
    protected $casts = [
        'id' => 'integer',
        'listing_id' => 'integer',
        'image' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    use SoftDeletes;
}
