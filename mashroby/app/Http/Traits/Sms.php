<?php


namespace App\Http\Traits;


trait Sms
{
    public static function sendSms ($message,$mobile) {
    $username = 'mustafa_123';
    $password = 'Mustafa123';
    $date = date('d/m/Y');
    $time = date('H:i');

 $api_url="http://www.shamelsms.net/api/httpSms.aspx?username=$username&password=$password&mobile=$mobile&message=$message&sender=SMS&unicodetype=u";
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$data = curl_exec($ch);
curl_close($ch);
return $data;
/* $ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.shamelsms.net/api/httpSms.aspx?username=$username&password=$password&mobile=$mobile
&message=$message&sender=SMS&unicodetype=u&date=$date&time=$time");

        curl_setopt($ch, true, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS,
//            "title=test-curl&message=test-curl-message");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
return $server_output;
// Further processing ...
//        if ($server_output == "OK") { ... } else { ... }
*/
    }
}
