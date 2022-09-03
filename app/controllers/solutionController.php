<?php

class solutionController extends Controller{

    public function solution1(){
        $ch = curl_init('http://103.219.147.17/api/json.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response, TRUE);
        $jsonData = !empty($json['data'])?$json['data']:"";
        $newData = explode(',', $jsonData);

        echo "<br>";
        echo "Output: <br>";
        echo "<pre>";
        echo "Total: (int)“Total count of the speeds those crossed 60”<br>";
        echo "list:";
        $speedData = [];
        foreach ($newData as $key=>$value){
            if(!($key&1)){
                unset($newData[$key]);
            }else{
                $str1 = ltrim($newData[$key], ' speed=');
                if($str1>60){
                    echo $str1."\n";
                }
            }
        }

        /**
         * If api server problem/internet disconnected
        **/

        if(empty($json['data'])){
            echo "api server problem or internet disconnected, Please check you internet connection/ check api server";
            die;
        }
    }

    public function solution2()
    {
        $array=array('z1','z10','z12','z2', 'z3');

        echo "Input: <br>";
        echo "<pre>";
        print_r($array);

        for($j = 0; $j < count($array); $j ++) {
            for($i = 0; $i < count($array)-1; $i ++){
                $str1 = ltrim($array[$i], 'z');
                $str2 = ltrim($array[$i+1], 'z');

                if($str1 > $str2) {
                    $temp = $array[$i+1];
                    $array[$i+1]=$array[$i];
                    $array[$i]=$temp;
                }
            }
        }

        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "Output: <br>";
        echo "<pre>";
        print_r($array);
    }

    public function solution3()
    {
        $ip = '192.168.0.1';
        $IpOctets = explode('.', $ip);

        $result = '';
        if(count($IpOctets)==4){
            for ($i=0; $i<=3; $i++){
                if($IpOctets[$i]>=0 && $IpOctets[$i]<=255){
                    $result = "true";
                }else{
                    $result = "false";
                    break;
                }
            }
        }else{
            $result = "false";
        }

        echo "Input: <br>".$ip."<br><br>";
        echo "Output: <br>";
        print_r($result);
    }

    public function index()
    {
        echo "welcome to my small library";
        die;
    }
}

?>