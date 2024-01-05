<?php

namespace App\Http\Controllers;

use App\Models\faq;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_meta;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faq = faq::orderBy('id', 'DESC')->get();
        return view('faq.faq_view', compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faq.add_faq');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        faq::create([
            "user_id" => Auth::user()->id,
            "question" => $request->question,
            "answer" => $request->answer,
        ]);
        return response()->json([
            "message" => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(faq $faq)
    {

        $faq_detail = faq::where('id', $faq->id)->first();

        return response()->json([
            'message' => 200,
            'data' => $faq_detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(faq $faq)
    {
        $delete =  faq::where('id', $faq->id)->delete();
        return response()->json([
            'message' => 200,
        ]);
    }

    public  function DetailFaq()
    {
        return  view('faq.DetailFaq');
    }
}
