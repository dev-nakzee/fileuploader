<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Webhooks extends Controller
{
    //
    public function receive(Request $request) {
        dd($request);
        $success = $request->success;
        // $data = $request->data;
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
