<?php

namespace App\Support;

use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * Method to invert auto the lat et lng to be human readed
 * We human or simple map read lat and then long
 * But the gis point make the opposite
 */
class GeoPoint
{
    public static function make(float $latitude, float $longitude, int $srid = 4326): Point
    {
        return new Point($longitude, $latitude, $srid);
    }
}
