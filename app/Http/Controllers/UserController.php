<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_meta;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Writer;
use Psy\Command\WhereamiCommand;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_meta = User::where('is_admin', 0)->latest()->get();
        $array = [];
        foreach ($user_meta as $user) {
            $meta = DB::table('user_meta')->where('user_id', $user->id)->first();
            if (!empty($meta)) {
                $array[$user->id] = $meta;
            } else {
                continue;
            }
        }
        return view('user.viewUser', compact('user_meta', 'array',));
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
        $validation =  $request->validate([
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $add_user =  User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => $request->password,
            'Is_admin' => 0,
            'Is_active' => 1,
        ]);

        $user = User::where("email", $request->email)->first();
        $user_meta = DB::table('user_meta')->where('user_id', $user->id)->first();
        if ($user_meta) {
            DB::table('user_meta')->where('user_id', $user->id)->update([
                "dob" => $request->dob,
                "contact_no" => $request->contact_no,
                "country" => $request->country,
                "state" => $request->state,
                "city" => $request->city,
                "zip_code" => $request->zip_code,
                "street_address" => $request->street_address,
            ]);
        } else {
            DB::table('user_meta')->insert([
                "user_id" => $user->id,
                "dob" => $request->dob,
                "contact_no" => $request->contact_no,
                "country" => $request->country,
                "state" => $request->state,
                "city" => $request->city,
                "zip_code" => $request->zip_code,
                "street_address" => $request->street_address,
            ]);
        }
        return response()->json([
            'data' => $add_user,
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit_userMeta = user_meta::where('user_id', $id)->first();
        if ($edit_userMeta) {
            $edit_user = User::where('id', $id)->first();
        }
        return view('user.updateUser ', compact('edit_userMeta', 'edit_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_meta_update = user_meta::where('user_id', $id)->update([
            "dob" => $request->dob,
            "contact_no" => $request->contact_no,
            "country" => $request->country,
            "state" => $request->state,
            "city" => $request->city,
            "zip_code" => $request->zip_code,
            "street_address" => $request->street_address,
        ]);

        if ($user_meta_update) {
            $user_update = User::where('id', $id)->update([
                'user_name' => $request->user_name,
                'email' => $request->email,
               
            ]);
        }
        return response()->json([
            'message' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_meta = user_meta::where('user_id', $id)->delete();
        if ($user_meta) {
            $user = User::where('id', $id)->delete();
        }
        return response()->json([
            'status' => 200,
        ]);
    }
    public function changeStatus($id)
    {
        $status = DB::table('users')->where('id', $id)->first();
        if ($status->Is_active == 1) {
            DB::table('users')->where('id', $id)->update([
                'Is_active' => 0
            ]);
        } else {
            DB::table('users')->where('id', $id)->update([
                'Is_active' => 1
            ]);
        }
        return response()->json([
            'status' => $status,
        ]);
    }
    public function userDetail($id)
    {
        $userDetail = user_meta::where('id', $id)->first();
        return  response()->json([
            'message' => $userDetail,
        ]);
    }
}
