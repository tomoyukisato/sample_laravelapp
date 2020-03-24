<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request as HttpRequest;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
// use Illuminate\Http\Request as HttpRequest;

class KintoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::get(["id","name","text"]);
        foreach($posts as $p){

            var_dump($p->name);
        }
        
        return view("posts.index",compact("posts"));
    }

    public function basic_request() {

        // $request = new HttpRequest();
        // $request->setUrl('https://freedive.cybozu.com/k/v1/record.json');
        // $request->setMethod(HTTP_METH_POST);
        
        // $request->setHeaders(array(
        //   'postman-token' => '1c086eaa-62d9-5e09-74b4-98e2303c2960',
        //   'cache-control' => 'no-cache',
        //   'x-cybozu-authorization' => 'c3VyZmF2ZTp4aTJ1UFR4ZDJAQlZEVnI=',
        //   'content-type' => 'application/json'
        // ));
        
        // $request->setBody('{"app":10,"record":{"id":{"value":100},"name":{"value":"test"},"plan":{"value":"test"},"price":{"value":1000},"agreement_date":{"value":"2020-03-26"},"device":{"value":"test"},"coverage_option":{"value":"\\\\u3042\\\\u308a"},"name_kana":{"value":"test"},"phone_number":{"value":"080-2222-2222"}}}');
        
        // try {
        //   $response = $request->send();
        
        //   echo $response->getBody();
        // } catch (HttpException $ex) {
        //   echo $ex;
        // }
        $method = "POST";

        $subDomain = env('KINTONE_SUBDOMAIN');//'http://example.com';
        // echo env('KINTONE_LOGIN');
        $url = "https://" . $subDomain . ".cybozu.com/k/v1/record.json";
                // リクエストヘッダ
        $headers = [

            // 'host' => 'freedive.cybozu.com:443',
            'X-Cybozu-API-Token' => '5kLjSNJTr8oRozz14iEBhDPSc0jFGbCXib1JBYsx',
            // 'x-cybozu-authorization' => base64_encode(env('KINTONE_LOGIN') . ':' . env('KINTONE_PASSWORD')),
            'Content-Type' => 'application/json',
        ];
        $client = new \GuzzleHttp\Client();
        
        $appId = 10;
        // $rsc = fopen("out.html", "w");
        // $header = array(
        //     "Host: " . $subDomain . ".cybozu.com:443",
        //     "Content-Type: application/json",
        //     // "X-Cybozu-Authorization: " . base64_encode(env('KINTONE_LOGIN') . ':' . env('KINTONE_PASSWORD')),
        //     "X-Cybozu-API-Token: 5kLjSNJTr8oRozz14iEBhDPSc0jFGbCXib1JBYsx"

        // );
        $body = http_build_query([
            'app'=> 10,
            'record' => [
                'id' => [
                    'value' => '100'
                ],
                'name' => [
                    'value' => 'test'
                ],
                'plan' => [
                    'value' => 'test'
                ],
                'price'=> [
                    'value' => '1000'
                ],
                'agreement_date'=> [
                    'value' => '2020-03-28'
                ],
                'device'=> [
                    'value' => 'test'
                ],
                'coverage_option'=> [
                    'value' => 'あり'
                ],
                'name_kana'=> [
                    'value' => 'test'
                ],
                'phone_number'=> [
                    'value' => '080-2222-2222'
                ]
               
            ]
        ], "", "&");

        $options = [
            'json' => $body,
            'headers' => [
                'host' => 'freedive.cybozu.com:443',
                'x-cybozu-api-token' => '5kLjSNJTr8oRozz14iEBhDPSc0jFGbCXib1JBYsx',
                'x-cybozu-authorization' => base64_encode(env('KINTONE_LOGIN') . ':' . env('KINTONE_PASSWORD')),
                'Content-Type' => 'application/json',
            ]
        ];

        $response = $client->request($method, $url, $options);


        

        
        // echo "bbb";

        // $stack = HandlerStack::create();
        // // my middleware
        // $stack->push(Middleware::mapRequest(function (RequestInterface $request) use (&$contentsRequest) {
        // $contentsRequest = (string)$request->getBody();
        // // echo '<pre>';
        //   var_dump($request);
        //   var_dump($contentsRequest);

        //   return $request;
        // }));
        // echo "</pre>";

        // echo json_encode($body);
        // $options = [
        //     'headers' => $headers,
        //     'json' => json_encode($body),
        //     //'{"app":10,"record":{"id":{"value":100},"name":{"value":"test"},"plan":{"value":"test"},"price":{"value":1000},"agreement_date":{"value":"2020-03-26"},"device":{"value":"test"},"coverage_option":{"value":"\\u3042\\u308a"},"name_kana":{"value":"test"},"phone_number":{"value":"080-2222-2222"}}}', // ここにぶち込むと勝手にjsonにしてくれる
        //     // 'http_errors' => false,
        //     'handler' => $stack,
        // // ];
        // $result = file_get_contents(
        //     $base_url,//"https://" . $subDomain . ".cybozu.com/k/v1/form.json", // URI
        //         false, // use_include_pathは必要ないのでfalse
        //         stream_context_create($context) // コンテキストの生成
        // );
        // var_dump(json_decode($result, true));
        // try {
        //     echo '<pre>';
        //      $response = $client->request('POST',$base_url, [
        //         'headers' => $headers,
        //         // 'form_params' => $body,
        //         'json' => json_encode($body),
        //         //'{"app":10,"record":{"id":{"value":100},"name":{"value":"test"},"plan":{"value":"test"},"price":{"value":1000},"agreement_date":{"value":"2020-03-26"},"device":{"value":"test"},"coverage_option":{"value":"\\u3042\\u308a"},"name_kana":{"value":"test"},"phone_number":{"value":"080-2222-2222"}}}', // ここにぶち込むと勝手にjsonにしてくれる
        //         // 'http_errors' => false,
        //         // 'handler' => $stack,
        //         // 'debug'=>true,
        //         // 'otheroptions'=>array()
        //         // 'query' => $body,
        //         // 'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$url) {
        //         //     echo $url = $stats->getEffectiveUri();
        //         // }
        //     ] )->getBody()->getContents();
        //     echo $url;
        // } catch (ClientException $e) {
        //     // echo $response = $e->getResponse();
        // }
        //  echo "aaaa";
        // var_dump($response->getBody());

        // $respononse_body = (string) $response->getBody();
        // var_dump($respononse_body);
    }
}
