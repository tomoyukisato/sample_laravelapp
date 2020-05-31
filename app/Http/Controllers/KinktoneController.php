<?php

namespace App\Http\Controllers;

use App\Post;
// use PEAR\HTTP_Request2;
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

        $url = 'https://freedive.cybozu.com/k/v1/record.json';
        $method ='POST';

        $header = array(
                "Host: " . env('KINTONE_SUBDOMAIN') . ".cybozu.com:443",
                "Content-Type: application/json",
                "X-Cybozu-Authorization: " . base64_encode(env('KINTONE_LOGIN') . ':' . env('KINTONE_PASSWORD')),
                "X-Cybozu-API-Token: 5kLjSNJTr8oRozz14iEBhDPSc0jFGbCXib1JBYsx"
        );
        // $body='{"app":10,"record":{"id":{"value":100},"name":{"value":"atest"},"plan":{"value":"test"},"price":{"value":1000},"agreement_date":{"value":"2020-03-27"},"device":{"value":"test"},"coverage_option":{"value":"\\u3042\\u308a"},"name_kana":{"value":"test"},"phone_number":{"value":"080-2222-2222"}}}';
        $body = json_encode([
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
                    'value' => 'test'
                ],
                'mail'=> [
                    'value' => 'test@gmail.com'
                ],
                'postal_code_mailing'=> [
                    'value' => '150-0001'
                ],
                'postal_code'=> [
                    'value' => '150-0001'
                ],
                'address'=> [
                    'value' => '東京都渋谷区'
                ],
                'agreement_year'=> [
                    'value' => '2020'
                ],
                'agreement_month'=> [
                    'value' => '11'
                ],
                'agreement_day'=> [
                    'value' => '29'
                ],
                'product_code'=> [
                    'value' => '商品コードtest'
                ],
                'update_year'=> [
                    'value' => '2022'
                ],
                'update_month'=> [
                    'value' => '2'
                ]
            ]
        ]);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
     
        if (!empty($body)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }
     
        $responseJsonText = curl_exec($curl);
        $body = json_decode($responseJsonText , true);
        var_dump($body);

        echo $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // $context = array(
        //     "http" => array(
        //         "method" => 'POST',
        //         "header" => implode("\r\n", $header),
        //         "content" => json_encode(array("app" => $appId))
        //     )
        // );
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
