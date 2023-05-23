<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use App\Models\hook_data;
use Illuminate\Http\Request;
use phpseclib3\Net\SSH2;

class ImageUploadController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $image = $request->file('file');
        $imageName = now()->timestamp;
        $filename = $imageName.'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'),$filename);
        
        $imageUpload = new ImageUpload();
        $imageUpload->filename = $filename;
        $imageUpload->image_id = $imageName;
        if($imageUpload->save()){
            $ssh = new SSH2(env('RM_IS_HOST'));
            if (!$ssh->login(env('RM_IS_USER'), env('RM_IS_PASS'))) {
                return response()->json(['success'=>new \Exception('Login failed')]);
            } else {
                //$ssh->exec('wget -P /root/AnimatedDrawings/examples/drawings '.env('APP_URL').'images/'.$imageName.'.'.$image->getClientOriginalExtension());
                return response()->json(['success'=>'wget -P /root/AnimatedDrawings/examples/drawings '.env('APP_URL').'images/'.$imageName.'.'.$image->getClientOriginalExtension()]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageUpload $imageUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImageUpload $imageUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImageUpload $imageUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageUpload $imageUpload)
    {
        //
    }
}
