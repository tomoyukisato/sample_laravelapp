<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scopeImage(int $id)
    {
        return Image::where("memo_id",$id)->get();
    }
    
    public function fileUpload(Request $request,int $id)
    {
        \Log::info("wwww");

        // $file = $request->file();
        // \Log::info($file);
        // $file = $request->files;
        
        \Log::info( $request->all() );
        \Log::info( $request['file'] );
        \Log::info( $id );
        
        // $name = $request->file->getClientOriginalName;//ファイル名を取得します。
        foreach($request['file'] as $key => $file){
            \Log::info( $key );
            \Log::info( $file );
            $file->storeAs('public/'.$id, $key."memu.png");
            Image::create([
                "memo_id"=>$id,
                "file_path"=>$id.'/'.$key.'memu.png',
            ]);
        }
        // $request->file->storeAs('public/'.$id, "memu.png");
        // Image::create([
        //     "memo_id"=>$id,
        //     "file_path"=>$id.'/memu.png',
        // ]);

        return response()->json([
            'result' => 'success',
        ]);

        // return $request->file('files');
        
    }
}
