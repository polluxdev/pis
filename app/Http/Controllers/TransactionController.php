<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Input;

class TransactionController extends Controller
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
     * Menampilkan Semua Transaksi dari api transaction_alltranslistget di menu Transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();

        $request = $client->request('GET', config('constants.url.transaction_alltranslistget'));

        $response = $request->getBody();

        $data = json_decode($response, true);
        $transaction = $data['data'];

        return view('moduls.transaction.index', ['transaction' => $transaction]);
    }

    /**
     * Menampilkan Detail Transaksi dari api transaction_alltransaget di menu Transaction
     * dan menampilkan 4 tabel yaitu Payment Request, Payment Notification, Payment Confirmation, dan Payment Log
     *
     * @return \Illuminate\Http\Response
     */
    public function showDetail()
    {
        $client = new Client();

        $body = Input::get('pis_order_id');

        $request = $client->request('GET', config('constants.url.transaction_alltransaget'), [
            'json' => ['PisOrderId' => $body]
        ]);

        $response = $request->getBody();

        $data = json_decode($response, true);
        $transaction = $data['data'];

        return view('moduls.transaction.detail', ['transaction' => $transaction]);
    }
}
