<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public $jsonCourses;
    public function show()
    {
        if (isset($_GET['status'])) {
            if (Cache::has('courses')) {
                
                $value = Cache::get('courses');
                 echo (json_encode($value));
            } else {
                $coursesDb = DB::select('select * from courses');
                Cache::put('courses', $coursesDb, 60);
                $value = Cache::get('courses');
                echo (json_encode($value)); 
                // echo('-');
            }

        }

    }

    public function load()
    {
        if (isset($_GET['status'])) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://nbrb.by/Services/XmlExRates.aspx",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
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
                $this->$jsonCourses = $jsonCourses = json_encode(simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA));

                Cache::forget('courses');
                $courses = json_decode($jsonCourses, true);
                DB::table('courses')->truncate();
                foreach ($courses["Currency"] as $key => $value) {

                    DB::insert('insert into courses (NumCode, CharCode,Scale,Name,Rate) values (?, ?, ?, ?, ?)', [$value['NumCode'], $value['CharCode'], $value['Scale'], $value['Name'], $value['Rate']]);
                }
                $coursesDb = DB::select('select * from courses');
                if($coursesDb){
                    echo (true);
                }
            }

        }
    }

}
