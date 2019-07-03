<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StandingFbController extends Controller
{
    public $tokenkey = "b96fbe0d0ae829943a353137fd1825624a627d8ddce4ce3572a24ce58ee51d92"; //token from apifootbal.com

    public function get_standings()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.apifootball.com/?action=get_standings&league_id=244&APIkey=$this->tokenkey",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Connection: keep-alive",
                "Host: apifootball.com",
                "Postman-Token: a794f214-b787-49c8-bd3b-c26edadaacc1",
                "User-Agent: PostmanRuntime/7.11.0",
                "accept-encoding: gzip, deflate",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

    public function get_events()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.apifootball.com/?action=get_events&from=2019-04-01&to=2019-04-03&league_id=148&APIkey=$this->tokenkey",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Connection: keep-alive",
                "Host: apifootball.com",
                "Postman-Token: a794f214-b787-49c8-bd3b-c26edadaacc1",
                "User-Agent: PostmanRuntime/7.11.0",
                "accept-encoding: gzip, deflate",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

    public function get_headtohead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team1' => 'required',
            'team2' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $t1 = $request->get('team1');
        $t2 = $request->get('team2');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.apifootball.com/?action=get_H2H&firstTeam=$t1&secondTeam=$t2&APIkey=$this->tokenkey",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Connection: keep-alive",
                "Host: apifootball.com",
                "Postman-Token: a794f214-b787-49c8-bd3b-c26edadaacc1",
                "User-Agent: PostmanRuntime/7.11.0",
                "accept-encoding: gzip, deflate",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

}
