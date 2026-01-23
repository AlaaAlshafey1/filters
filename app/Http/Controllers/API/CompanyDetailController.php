<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Http\Resources\CompanyDetailResource;

class CompanyDetailController extends Controller
{
    public function index($section_key, Request $request)
    {
        $detail = CompanyDetail::where('section_key', $section_key)
                    ->where('is_active', 1)
                    ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => new CompanyDetailResource($detail)
        ]);
    }
}
