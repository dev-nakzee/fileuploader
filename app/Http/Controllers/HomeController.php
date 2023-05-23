<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hook_data;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function receive(Request $request) {
        dd($request);
        $success = $request->success;
        $data = $request->data;
        if($success == 1) {
            $rawdata = new hook_data();
            $rawdata->raw_data = $data;
            if($rawdata->save()) {
                return response()->json(['success'=>'1', 'message'=>'Data received successfully']);
            }
        } else {
            return response()->json(['success'=>'0', 'message'=>'Data failed to receive']);
        }
    }
}
