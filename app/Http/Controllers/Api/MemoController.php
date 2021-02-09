<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Memo;
use App\Image;


class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Memo::select("title","start","end","content","id")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info("request");

        \Log::info($request);
        \Log::info($request->date);
        $start= date('Y/m/d 0:00:00', strtotime($request->date));
        $end= date('Y/m/d 0:00:00', strtotime( $start ));
        \Log::info($start);
        \Log::info($end);
        return Memo::create([
            'title' => $request->title,
            'content' => $request->content,
            'start' => $start,
            'end' => $end,
            'allDay' => 1,
            'user_id' => 1
        ]);
    }
    
    public function fileUpload(Request $request,int $id)
    {
        \Log::info("requestb");
       

        // $file = $request->file();
        // \Log::info($file);
        // $file = $request->files;
        
        \Log::info( $request->all() );
        \Log::info( $request['file'] );
        \Log::info( $id );
        \Log::info("rerere");
        // $name = $request->file->getClientOriginalName;//ファイル名を取得します。
        foreach($request['file'] as $key => $file){
            \Log::info( $key );
            \Log::info( $file );
            // $file->storeAs('public/'.$id, $key."memu.png");
            // Image::create([
            //     "memo_id"=>$id,
            //     "file_path"=>$id.'/memu.png',
            // ]);
        }

        return response()->json([
            'result' => 'success',
        ]);

        // return $request->file('files');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $start= date('Y/m/d 0:00:00', strtotime($request->date));
        // $end= date('Y/m/d 0:00:00', strtotime( $start ));
 
        
        \Log::info("success");
        $memo = Memo::where("id",$id);
        $memo->update(
            [
                'title' => $request->title,
                'content' => $request->content,
            ]
        );
        return $id;
        // return Memo::create([
        //     'title' => $request->title,
        //     'content' => $request->content,
        //     'start' => $start,
        //     'end' => $end,
        //     'allDay' => 1,
        //     'user_id' => 1
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
