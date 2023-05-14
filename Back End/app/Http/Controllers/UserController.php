<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('country')->get();
        return response()->json($users);
    }
    public function edit(User $id)
    {
        return response()->json($id);
    }
    public function Delete(User $id)
    {
        $id->delete();
        return response()->json(["message" => "User Deleted Successfully"]);
    }
    public function store(Request $request)
    {

        $request->validate([
            "nationality" => "required",
            "email" => "required",
            "country" => "required",
            "Religious" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "user_name" => "required",
            "email" => "required",
            "phone" => "required",
            "whatsapp" => "required",
            "password" => "required",
            "date_of_birth" => "required",
            "gander" => "required",
            "nid" => "required",
            "healt_status" => "required",
            "profileImage" => "required",
        ]);
        $image = $request->file('profileImage')->store("/User");
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->nationality = $request->nationality;
        $user->country_id = $request->country;
        $user->Religious = $request->Religious;
        $user->whatsapp = $request->whatsapp;
        $user->date_of_birth = $request->date_of_birth;
        $user->gander = $request->gander;
        $user->healt_status = $request->healt_status;
        $user->nid = $request->nid;
        $user->password = bcrypt($request->password);
        $user->image = $image;
        $user->save();
        return response()->json("User Saved Successfuly");
    }
    public function chack(Request $request)
    {
        $request->validate([
            "nationality" => "required",
            "country" => "required",
            "Religious" => "required",
        ],[
            "nationality.required"=>'ملیت را انخاب کنید',
            "country.required"=>'کشور را انخاب کنید',
            "Religious.required"=>'منطقه را انخاب کنید',
        ]);

        return response()->json(["message" => true]);
    }
    public function chackAcount(Request $request)
    {
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "user_name" => "required",
            "email" => "required",
            "phone" => "required",
            "whatsapp" => "required",
            "password" => "required",
        ]);

        return response()->json(["message" => true]);
    }
    public function chackPersonalInfo(Request $request)
    {
        $request->validate([
            "date_of_birth" => "required",
            "gander" => "required",
            "healt_status" => "required",
            "national_id" => "required",
            "profileImage" => "required",
        ]);

        return response()->json(["message" => true]);
    }
    public function update(Request $request, User $id)
    {
        if ($request->file('image')) {
            $image = $request->file('image')->store('/User');
            $id->image = $image;
        }
        $id->first_name = $request->first_name;
        $id->email = $request->email;
        $id->phone = $request->phone;
        $id->religious = $request->religious;
        $id->update();
        return response()->json((["message" => "Data Updateded"]));
    }
    public function GetCountry()
    {
        $country = country::get();
        return response()->json(["country" => $country]);
    }
}
