<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Area;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;
use App\Support\GeoPoint;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userCoach = User::firstOrCreate(
            ['email' => 'coach@freecaribou.net'],
            ['name' => 'Red Coach', 'password' => 'helloworld', 'email_verified_at' => now(), 'role' => 'coach']
        );
        $userAdmin = User::firstOrCreate(
            ['email' => 'redpostmen@freecaribou.net'],
            ['name' => 'Red Admin', 'password' => 'helloworld', 'email_verified_at' => now(), 'role' => 'admin']
        );
        $userSimple = User::firstOrCreate(
            ['email' => 'johndoe@freecaribou.net'],
            ['name' => 'Johndoe', 'password' => 'helloworld', 'email_verified_at' => now(), 'role' => 'user']
        );

        $areaOne = Area::create([
            'label' => 'Samy house',
            'description' => 'House of the Samy\'s castle',
            'delimitation' => new Polygon([
                new LineString([
                    GeoPoint::make(50.84869861829053, 4.3457505579357285),
                    GeoPoint::make(50.8479873202758, 4.345845388342124),
                    GeoPoint::make(50.848791020861405, 4.34756360986613),
                    GeoPoint::make(50.84869861829053, 4.3457505579357285),
                ])
            ], Srid::WGS84->value),
        ]);

        $areaTwo = Area::create([
            'label' => 'Caribou house',
            'description' => 'House of the Caribou\'s castle',
            'delimitation' => new Polygon([
                new LineString([
                    GeoPoint::make(50.848813548269064, 4.345356655267758),
                    GeoPoint::make(50.849685044733604, 4.345406275384614),
                    GeoPoint::make(50.84920373007174, 4.344021423032328),
                    GeoPoint::make(50.848813548269064, 4.345356655267758),
                ])
            ], Srid::WGS84->value),
        ]);
    }
}
