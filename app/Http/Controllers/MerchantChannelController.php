<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Input;

class MerchantChannelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $client = new Client();

        $request = $client->request('GET', config('constants.url.merchants_allget'));

        $response = $request->getBody();

        $data = json_decode($response, true);
        $merchant = array_values(Arr::sort($data['data'], function ($value) {
            return $value['merchantCode'];
        }));

        return view('moduls.masterdata.merchantChannel.index', ['merchant' => $merchant]);
    }

    /**
     * Menampilkan tabel dari Merchant Channel berdasarkan Merchant Code dari api merchant_channel_singleget
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingle()
    {
        $client = new Client();

        $body = Input::get('code');


        $request = $client->request('GET', config('constants.url.merchant_channel_singleget'), [
            'json' => ['MerchantCode' => $body]
        ]);

        $response = $request->getBody();

        $data = json_decode($response, true);
        $channel = $data['data'];

        return view('moduls.masterdata.merchantChannel.table', ['channel' => $channel]);
    }

}
