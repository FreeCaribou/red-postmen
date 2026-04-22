<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Inertia\Inertia;

class AreaController extends Controller
{

    public function getAll()
    {
        $areas = Area::get();

        return Inertia::render('my-points', ['areas' => $areas]);
    }
}
