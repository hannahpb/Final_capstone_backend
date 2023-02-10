<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\MedsModel;
use Illuminate\Http\Request;

class MedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function store(Request $request)
    {
        $meds = new MedsModel();
        $meds->fname = $request->fname;
        $meds->lname = $request->lname;
        $meds->aptcategory = $request->aptcategory;
        $meds->aptdate = $request->aptdate;
        $meds->apttime = $request->apttime;
        $meds->aptpurpose = $request->aptpurpose;
        $meds->user_id = $request->user_id;
        $meds->save();

        return response()->json([
            'status' => 200,
            'meds' => $meds
        ]);
    }
    public function index($key)
    {
        $meds = MedsModel::where('user_id', '=', "$key")
        ->get();
        return response()->json([
            'status'=> 200,
            'meds'=>$meds
        ]);
    }
    public function all()
    {
        $meds = MedsModel::all();
        return response()->json([
            'status'=> 200,
            'meds'=>$meds,
        ]);
    }
}
