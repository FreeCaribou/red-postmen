<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Inertia\Inertia;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use App\Support\GeoPoint;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{

    public function getAll()
    {
        $areas = Area::get();

        return Inertia::render('my-areas', ['areas' => $areas]);
    }

    // TODO show success message in frontend
    public function add(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'delimitation' => ['required', 'array', 'min:4'],
            'delimitation.*' => ['required', 'array', 'size:2'],
            'delimitation.*.0' => ['required', 'numeric', 'between:-90,90'],   // lat
            'delimitation.*.1' => ['required', 'numeric', 'between:-180,180'], // lng
        ]);

        $points = array_map(
            fn($point) => GeoPoint::make($point[0], $point[1]), // lat, lng
            $request->delimitation
        );

        $delimitation = new Polygon([
            new LineString($points)
        ], Srid::WGS84->value);

        Area::create([
            'label' => $request->label,
            'description' => $request->description,
            'delimitation' => $delimitation
        ]);

        Log::info('Creation of area');
        return redirect()->route('my-areas')->with('success', 'area.new-area-addedd-success');
    }
}
