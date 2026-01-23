<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Faq;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\FaqResource;

class ServicesFaqsController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', 1)->get();
        $faqs = Faq::where('is_active', 1)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'services' => ServiceResource::collection($services),
                'faqs'     => FaqResource::collection($faqs),
            ]
        ]);
    }
}
