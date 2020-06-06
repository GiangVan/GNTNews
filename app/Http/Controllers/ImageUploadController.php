<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUpload()
    {
        return view('imageUpload');
    }

  

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUploadPost()
    {
        //exit('aaa');
        // request()->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        
        $imageName = time().'.'.request()->upload->getClientOriginalExtension();

        request()->upload->move(public_path('images'), $imageName);
        // return back()->with('success','You have successfully upload image.')->with('image',$imageName);
        return response()->json([
            'fileName' => $imageName,
            'uploaded' => 1,
            'url' => url('images/'.$imageName)
        ]);
    }
}
