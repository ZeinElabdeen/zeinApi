<?php


namespace App\Http\Traits;


trait Sms
{
    public static function send () {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://uriallab.com/monasbat/public/api/contact_us");
        curl_setopt($ch, true, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "title=test-curl&message=test-curl-message");

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
    }
}
