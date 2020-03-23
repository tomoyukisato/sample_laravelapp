<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

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
// $request->setUrl('http://freedive.cybozu.com/k/v1/record.json');
// $request->setMethod(HTTP_METH_POST);

// $request->setHeaders(array(
//   'postman-token' => '7d5caf03-16ea-6b57-f543-469030594868',
//   'cache-control' => 'no-cache',
//   'x-cybozu-api-token' => '5kLjSNJTr8oRozz14iEBhDPSc0jFGbCXib1JBYsx',
//   'x-cybozu-authorization' => 'c3VyZmF2ZTp4aTJ1UFR4ZDJAQlZEVnI=',
//   'content-type' => 'application/json',
//   'host' => 'freedive.cybozu.com:443'
// ));

// $request->setBody('{"app":10,"record":{"id":{"value":100},"name":{"value":"test"},"plan":{"value":"test"},"price":{"value":1000},"agreement_date":{"value":"2020-03-26"},"device":{"value":"test"},"coverage_option":{"value":"\\\\u3042\\\\u308a"},"name_kana":{"value":"test"},"phone_number":{"value":"080-2222-2222"}}}');

// try {
//   $response = $request->send();

//   echo $response->getBody();
// } catch (HttpException $ex) {
//   echo $ex;
// }

        $subDomain = env('KINTONE_SUBDOMAIN');//'http://example.com';
        // echo env('KINTONE_LOGIN');
        $base_url = "https://" . $subDomain . ".cybozu.com/k/v1/record.json";
                // リクエストヘッダ
                $headers = [

                    // 'host' => 'freedive.cybozu.com',
                    'x-cybozu-api-token' => '5kLjSNJTr8oRozz14iEBhDPSc0jFGbCXib1JBYsx',
                    'x-cybozu-authorization' => base64_encode(env('KINTONE_LOGIN') . ':' . env('KINTONE_PASSWORD')),
                    ' Content-Type' => 'application/json',
                ];
        $client = new \GuzzleHttp\Client();
        
        $appId = 10;
        // $rsc = fopen("out.html", "w");

            // "Host: " . $subDomain . ".cybozu.com:443",
            // "Content-Type: application/json",
            // "X-Cybozu-Authorization: " . base64_encode(env('KINTONE_LOGIN') . ':' . env('KINTONE_PASSWORD')),
            // "X-Cybozu-API-Token: 5kLjSNJTr8oRozz14iEBhDPSc0jFGbCXib1JBYsx"

        // );
        $body = [
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
        ];
        // $body = [
        //     'app'=> 10,
        //     'id' => '100',
        //     'name' => 'test',
        //     'plan' => 'test',
        //     'price' => '1000',
        //     'agreement_date' => '2020-03-28',
        //     'device' => 'test',
        //     'coverage_option' => 'あり',
        //     'name_kana' => 'test',
        //     'phone_number' => '080-2222-2222'
        // ];

        
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
        // ];
        try {
            echo '<pre>';
             $response = $client->request('POST',$base_url, [
                'headers' => $headers,
                // 'form_params' => $body,
                'json' => json_encode($body),
                //'{"app":10,"record":{"id":{"value":100},"name":{"value":"test"},"plan":{"value":"test"},"price":{"value":1000},"agreement_date":{"value":"2020-03-26"},"device":{"value":"test"},"coverage_option":{"value":"\\u3042\\u308a"},"name_kana":{"value":"test"},"phone_number":{"value":"080-2222-2222"}}}', // ここにぶち込むと勝手にjsonにしてくれる
                // 'http_errors' => false,
                // 'handler' => $stack,
                // 'debug'=>true,
                // 'otheroptions'=>array()
                // 'query' => $body,
                // 'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$url) {
                //     echo $url = $stats->getEffectiveUri();
                // }
            ] )->getBody()->getContents();
            echo $url;
        } catch (ClientException $e) {
            // echo $response = $e->getResponse();
        }
        //  echo "aaaa";
        // var_dump($response->getBody());

        // $respononse_body = (string) $response->getBody();
        // var_dump($respononse_body);
    }
}
