<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct() {

    //    $this->middleware('auth');

    }

    public function stream(Request $request) {

        $path = storage_path('video/misocaAPIデモ.mp4');

        $file_size = filesize($path);
        $fp = fopen($path, 'rb');
        $status_code = 200;
        $headers = [
            'Content-type' => 'video/mp4',
            'Accept-Ranges' => 'bytes',
            'Content-Length' => $file_size
        ];

        $range = $request->header('Range');

        if(!is_null($range)) {

            if(preg_match('|bytes=([0-9]+)\-|', $range, $matches)) {

                $start = intval($matches[1]);

                if(fseek($fp, $start) === 0) {

                    $status_code = 206;
                    $headers['Content-Length'] = $file_size - $start;
                    $headers['Content-Range'] = sprintf(
                        'bytes %d-%d/%d',
                        $start,
                        ($file_size-1),
                        $file_size
                    );

                }

            }

        }

        return response()->stream(function() use($fp) {

            fpassthru($fp);

        }, $status_code, $headers);

    }
}
