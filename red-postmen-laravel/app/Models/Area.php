<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

/**
 * An area to be shown as polygon on the map
 * 
 * id -> int
 * label -> string (255) not null
 * description -> string (2000) null
 * delimitation -> gis polygon {type: string, coordinates: [lat,long[]]}
 * timestamps
 */
class Area extends Model
{

    use HasSpatial;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'label',
        'description',
    ];

    protected $casts = [
        'delimitation' => Polygon::class,
    ];
}
