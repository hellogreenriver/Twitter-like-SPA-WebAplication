<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\person;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DateResource;


class ApiController extends Controller
{

    
    public function index()
    {
        return DateResource::collection(person::all());
    }

    public function personalTweet()
    {
        $id = Auth::id();
        $user = person::with('user')->where('person_id', $id)->get();
        return DateResource::collection($user);
    }

    public function create(Request $request)
    {
        $id = Auth::id();
        $name = Auth::user()->name;
        person::create([
            "person_id" => $id,
            "name" => $name,
            "comment" => $request->comment,
        ]);
        return response()->json(['message' => 'tweet sucess'],);
    }

    public function delete($id)
    {
        person::where('id', $id)->delete();
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $search = person::where('name', 'LIKE', "%$keyword%")->orWhere('comment', 'LIKE', "%{$keyword}%")->get();
        return DateResource::collection($search);
    }
}
