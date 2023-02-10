<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //testing lang
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function medhistory($key)
    {
        $apt = Appointment::where('user_id', '=', "$key")
        ->where('aptverify', '=', 'Accepted')
        ->get();
        return response()->json([
            'status'=> 200,
            'apt'=>$apt
        ]);
    }
    public function all()
    {
        $apt = Appointment::all();
        return response()->json([
            'status'=> 200,
            'apt'=>$apt,
        ]);
    }
    public function search($key)
    {
        $apt = Appointment::where('aptdate', 'Like', "%$key%")->get();
        return response()->json([
            'status'=> 200,
            'apt'=>$apt,
        ]);
    }
    public function index()
    {
        $apt = Appointment::where('aptcategory', 'Clinic')
        ->orderBy('aptdate', 'asc')
        ->get();

        return response()->json([
            'status'=> 200,
            'appointment'=> $apt,
        ]);
    }

    public function store(Request $request)
    {
        $apt = new Appointment();
        $apt->fname = $request->fname;
        $apt->lname = $request->lname;
        $apt->aptcategory = $request->aptcategory;
        $apt->aptdate = $request->aptdate;
        $apt->apttime = $request->apttime;
        $apt->aptpurpose = $request->aptpurpose;
        $apt->aptverify = $request->aptverify;
        $apt->user_id = $request->user_id;

        $apt->save();

        return response()->json([
            'status' => 200,
            'appointment' => $apt
        ]);
    }
    public function edit($id)
    {
        $apt = Appointment::find($id);
        if($apt)
        {
            return response()->json([
                'status'=> 200,
                'appointment' => $apt,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Appointment ID Found',
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $apt = Appointment::find($id);
        if($apt)
        {
            $apt->fname = $request->fname;
            $apt->lname = $request->lname;
            $apt->aptcategory = $request->aptcategory;
            $apt->aptdate = $request->aptdate;
            $apt->apttime = $request->apttime;
            $apt->aptpurpose = $request->aptpurpose;
            $apt->aptverify = $request->aptverify;
            $apt->user_id = $request->user_id;
            $apt->update();

            return response()->json([
                'status'=> 200,
                'message'=>'Appointment Updated Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Appointment ID Found',
            ]);
        }
    }

    public function dental()
    {
        $apt = Appointment::where('aptcategory', 'Dental')->get();

        return response()->json([
            'status'=> 200,
            'appointment'=> $apt,
        ]);
    }

    public function find($key)
    {
        $apt = Appointment::where([
            ['user_id', 'Like', "%$key%"],
            ['aptverify', 'Like', "Accepted"]
        ])->get();

        return response()->json([
            'status'=> 200,
            'appointment'=>$apt,
        ]);
    }

    public function pending()
    {
        $IG = Appointment::where('aptverify', 'Like', "Processing")->get();
        $IGG = $IG->count();
        return response()->json([
            'status'=> 200,
            'all'=> $IGG
        ]);
    }

    public function accepted()
    {
        $IG = Appointment::where('aptverify', 'Like', "Accepted")->get();
        $IGG = $IG->count();
        return response()->json([
            'status'=> 200,
            'all'=> $IGG
        ]);
    }
}
