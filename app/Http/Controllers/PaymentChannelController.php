<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Input;

class PaymentChannelController extends Controller
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

        $request = $client->request('GET', config('constants.url.payment_channel_allget'));

        $response = $request->getBody();

        $data = json_decode($response, true);
        $payment = $data['data'];


        return view('moduls.masterdata.paymentChannel', ['payment' => $payment]);
    }

    /**
     * Menampilkan satu Payment Channel dari api payment_channel_singleget
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingle()
    {
        $client = new Client();

        $body = Input::get('code');


        $request = $client->request('GET', config('constants.url.payment_channel_singleget'), [
            'json' => ['PaymentChannelCode' => $body]
        ]);

        $response = $request->getBody();

        $data = json_decode($response, true);
        $payment = $data['data']['0'];

        return response()->json([
            'value' => $payment
        ]);
    }

}
