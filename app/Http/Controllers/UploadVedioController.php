<?php

namespace App\Http\Controllers;

use App\Models\upload_vedio;
use App\Models\faq;
use Illuminate\Http\Request;

class UploadVedioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = upload_vedio::all();

        return view('vedio.view_uploadedVedio', compact('data'));
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

        $request->validate([
            'title' => 'required',
            'upload_vedio' => 'required',
        ]);

        if ($request->file('upload_vedio')) {
            $upload_vedio = $request->file('upload_vedio');
            $vedio_ext = $upload_vedio->getClientOriginalExtension();
            $vedio_name = 'video_' . time() . '.' . $vedio_ext;
            $upload_vedio->move('video/', $vedio_name);
            upload_vedio::create([
                'title' => $request->title,
                'vedio' => $vedio_name,
            ]);
            return response()->json(['message' => 200]);
        }
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
    public function edit($id)
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
    public function destroy(upload_vedio $upload_vedio, $id)
    {

        $get_video = upload_vedio::findOrFail($id);
        $delete_video = upload_vedio::where('id', $get_video->id)->delete();
        if ($delete_video) {
            unlink(public_path() . '/video/' . $get_video->vedio);
            return 200;
        } else {
            return 300;
        }
    }
    public  function uservedio()
    {
        $vedio =   upload_vedio::all();
        return view('user_video.vedio', compact('vedio'));
    }
}
