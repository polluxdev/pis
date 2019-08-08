<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    public function index()
    {
        $client = new Client();

        $request = $client->request('GET', config('constants.url.transaction_alltranslistget'));

        $response = $request->getBody();

        $data = json_decode($response, true);
        $transaction = $data['data'];

        return view('moduls.report.transaction', ['transaction' => $transaction]);
    }

    public function getReport()
    {
        $client = new Client();

        $request = $client->request('GET', config('constants.url.transaction_alltranslistget'));

        $response = $request->getBody();

        $data = json_decode($response, true);
        $transaction = $data['data'];

        return view('moduls.report.table', ['transaction' => $transaction]);
    }
}
