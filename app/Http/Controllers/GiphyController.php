<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GiphyController extends Controller
{
    private $giphy;

    public function __construct()
    {
        $this->auth = [
            'api_key' => 'DFPicgYW9MNON1LvoF1osnxQ99SRi3Pg',
            
        ];

        $this->giphy = new Client([
            'base_uri' => 'http://api.giphy.com',
            'headers' => $this->auth,
        ]);
    }

    public function index(){

        $response = $this->giphy->request('GET','v1/gifs/trending',[
            'query' => [
                'limit' => 10,
            ],
        ])->getBody()->getContents();

        $giphy_trending = json_decode($response);

       /*  foreach($giphy_trending->data as $giphy){

            dd($giphy->images->original->url);
        } */

        return view('index',compact('giphy_trending'));
    }
}
