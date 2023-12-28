<?php

namespace App\Http\Controllers;

use App\Models\user_meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $select_id = DB::table('users')->where('email', $request->email)->first();
        return $select_id;
    }


    /**
     * Display the specified resource.
     */
    public function show(user_meta $user_meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_meta $user_meta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user_meta $user_meta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_meta $user_meta)
    {
        //
    }
}
