<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Memcached;

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

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                /* $Json = json_encode(simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA));

                $courses = json_decode($Json, true);
                DB::table('courses')->truncate();
                foreach ($courses["Currency"] as $key => $value) {
                DB::insert('insert into courses (NumCode, CharCode,Scale,Name,Rate) values (?, ?, ?, ?, ?)', [$value['NumCode'], $value['CharCode'],$value['Scale'],$value['Name'],$value['Rate']]);
                }
                $coursesDb = DB::select('select * from courses');
                echo (json_encode($coursesDb)); */
                // $redis = Redis::connection();
                /* Redis::set('name', 'Taylor');

                $name = Redis::get('name');*/

                // Cache::put('key', 'value');
                // $value = Cache::get('name','ddddd');
                /* Cache::store('redis')->put('bar', 'baz', 600);
                $value = Cache::get('bar'); */
                $memcached = new \Memcached();
                $memcached->addServer('localhost', 11211);

// get(prefix:key)
                $value = $memcached->get('laravel:categories');
                // $values = Redis::lrange('names', 5, 10);
                echo ($value);
            }

            // return view('stud_view',['courses'=>$courses]);

        }

        // return view('api.show', ['response' => $response, 'error'=>$err]);
    }

    public function load()
    {

        return view('api.load');
    }
}
