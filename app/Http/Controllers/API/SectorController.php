<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::all()->map(function ($sector) {
            return [
                'id' => $sector->id,
                'title_ar' => $sector->title_ar,
                'title_en' => $sector->title_en,
                'desc_ar' => $sector->desc_ar,
                'desc_en' => $sector->desc_en,
                'image' => $sector->image ? asset('storage/' . $sector->image) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $sectors
        ]);
    }

    public function show($id)
    {
        $sector = Sector::find($id);

        if (!$sector) {
            return response()->json([
                'success' => false,
                'message' => 'Sector not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $sector
        ]);
    }
}
