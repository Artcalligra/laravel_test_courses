<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{

    public function show()
    {
        if (isset($_GET['status'])) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://nbrb.by/Services/XmlExRates.aspx",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                // CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            /* if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                print_r(json_decode($response));
            } */

            $Json = json_encode(simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA));
            echo $Json;
        }

        // return view('api.show', ['response' => $response, 'error'=>$err]);
    }

    public function load()
    {

        return view('api.load');
    }
}
