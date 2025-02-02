<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Illuminate\Http\JsonResponse;
class BannerController extends Controller
{
  
    public function index()
    {
        $banner=Banner::orderBy('id','DESC')->paginate(10);
        return response()->json($banner);
    }

    public function store(StoreBannerRequest $request): JsonResponse
    {
        $banner=Banner::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Banner created successfully.',
            'data' => $banner
        ], 201);
    }

    public function show(Banner $banner): JsonResponse
    {
        return response()->json($banner);   
    }
    
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $banner->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Banner updated successfully.',
            'data' => $banner
        ]);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return response()->json([
            'status' => true,
            'message' => 'Banner deleted successfully.'
        ]);
    }
}
