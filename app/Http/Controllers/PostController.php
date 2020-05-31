<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::get(["id","name","text"]);
        // foreach($posts as $p){

        //     var_dump($p->name);
        // }
        // echo Carbon::now('Asia/Tokyo');
        // return view("posts.index",compact("posts"));

        //->toDateString();
        $end = Carbon::now('Asia/Tokyo')->endOfWeek(); //->toDateString();

        $i = 0;
        $a = 0;
        $weeks = [
            [
                "user_id" =>1,
                "week_id" =>1,
                "timezone_id" =>1,
            ],
            [
                "user_id" =>2,
                "week_id" =>3,
                "timezone_id" =>1,
            ],
            [
                "user_id" =>2,
                "week_id" =>3,
                "timezone_id" =>1,
            ],            [
                "user_id" =>2,
                "week_id" =>5,
                "timezone_id" =>1,
            ],            [
                "user_id" =>2,
                "week_id" =>6,
                "timezone_id" =>1,
            ],            [
                "user_id" =>2,
                "week_id" =>2,
                "timezone_id" =>1,
            ],
        ];
        //BaseShift::get(['user_id', 'week_id', 'timezone_id']);

        $date = 0;
        $a = 0;
        foreach ($weeks as $week) {
            // var_dump($week);
            $start = Carbon::now('Asia/Tokyo')->startOfWeek(); 

            $user_id = $week["user_id"];
            $w = $week["week_id"];
            $timezone_id = $week["timezone_id"];
            
            // echo $start;
            // echo $end;
            $week_id;
            // var_dump($week).'<br>';
            $this->getDate($w , $start,$end);
            // for ($a = $start ; $start < $end ; $start->addDays(1) ) {
            //     echo "aaa".$w;
            //     //echo $start.'(start)<br>';
            //     // $start->dayOfWeekIso;
            //     // $date = $start;
            //     // echo "a";
            //     // var_dump($week).'<br>';
            //     // echo "week";
            //     // var_dump($w).'<br>';
            //     // if ($a === $week_id) {
            //     //     //echo $start . "<br>";
            //     //     $result = $date;
            //     // }
            //     // // var_dump($result);
            //      $start = $start->addDays(1);
            // }
            // dump($result);
            // echo "test".$week_id;
            // $data[$i] = [
            //     'user_id' => $user_id,
            //     'week_id' => $w,
            //     'timezone_id' => $timezone_id,
            //     // 'date' => $result->toDateString(),
            // ];
            echo $i++."回";
        }
        // dump($data);

    }
    public function getDate($week, $start, $end){

        while( $start < $end ){
            $d = $start->dayOfWeekIso;
            $d = $d - 1; 
            if ($d === $week) {
                $result = $d;
            }
            $start = $start->addDays(1);
        }
        return $date;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $types = Type::all();
        // return view("posts.create",compact("types"));
        // return view("posts.create",compact("types"));
        return view("posts.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->name = $request->name;
        $post->type = $request->type_id;
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();
        return redirect('posts/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::find($post);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::find($post);
        return view("posts.edit",compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //$post = Post:where("id", "=" , $request->id );
        $post->name = $request->name;
        $post->type = $request->type_id;
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();
        return redirect('posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
