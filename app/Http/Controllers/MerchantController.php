<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Input;

class MerchantController extends Controller
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
        $merchant = $data['data'];


        return view('moduls.masterdata.merchant', ['merchant' => $merchant]);
    }

    /**
     * Menampilkan satu Merchant dari api merchants_singleget
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingle()
    {
        $client = new Client();

        $body = Input::get('code');


        $request = $client->request('GET', config('constants.url.merchants_singleget'), [
            'json' => ['MerchantCode' => $body]
        ]);

        $response = $request->getBody();

        $data = json_decode($response, true);
        $merchant = $data['data']['0'];

        return response()->json([
            'value' => $merchant
        ]);
    }

}
