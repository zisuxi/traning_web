<?php

namespace App\Http\Controllers;

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '0');

use App\Models\upload_vedio;
use Illuminate\Http\Request;

class UploadVedioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return   view('vedio.upload_vedio');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->file('upload_vedio')) {
            $upload_vedio = $request->file('upload_vedio');
            $vedio_ext = $upload_vedio->getClientOriginalExtension();
            $vedio_name = 'video_' . time() . '.' . $vedio_ext;
            $upload_vedio->move('video/', $vedio_name);
            upload_vedio::create([
                'title' => $request->title,
                'vedio' => $vedio_name,
            ]);

            return response()->json(['status' => 'success'], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'No video uploaded.'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(upload_vedio $upload_vedio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(upload_vedio $upload_vedio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, upload_vedio $upload_vedio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(upload_vedio $upload_vedio)
    {
        //
    }
}
