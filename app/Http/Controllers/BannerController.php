<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner=Banner::orderBy('id','DESC')->paginate(10);
        return response()->json($banner);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        $banner=Banner::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Banner created successfully.',
            'data' => $banner
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner): JsonResponse
    {
        return response()->json($banner);   
    }
    



    /**
     * Update the specified resource in storage.
     */
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
