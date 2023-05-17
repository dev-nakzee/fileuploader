<?php

namespace App\Http\Controllers;

use App\Models\ImageUpload;
use Illuminate\Http\Request;
use phpseclib3\Net\SFTP;

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
        $image->move(public_path('images'),$imageName.'.'.$image->getClientOriginalExtension());
        
        // $imageUpload = new ImageUpload();
        // $imageUpload->filename = $imageName.'.'.$image->getClientOriginalExtension();
        // $imageUpload->image_id = $imageName;
        // $imageUpload->save();

        $sftp = new SFTP(env('RM_IS_HOST'));
        if (!$sftp->login(env('RM_IS_USER'), env('RM_IS_PASS'))) {
            throw new \Exception('Login failed');
        } else {
            if($sftp->put(env('RM_IS_IDIR').$imageName.'.'.$image->getClientOriginalExtension(), storage_path().$imageName.'.'.$image->getClientOriginalExtension(), SFTP::SOURCE_LOCAL_FILE)){
                return response()->json(['success'=>$imageName]);
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
