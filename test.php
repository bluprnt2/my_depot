<?php
            date_default_timezone_set("UTC");
            $current_time = time();
            $api_url =  "/var/www/html/senior/tutor_web_app/api//Auth/token.php";
            $curl = curl_init();
            $params = array();

            $params['client_id'] = 'testclient';
            $params['client_secret'] = 'testpass';

            $params['grant_type'] = 'client_credentials';
            curl_setopt($curl, CURLOPT_URL, $api_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            curl_setopt($curl, CURLOPT_POST, 1);
            echo curl_exec($curl);
            $token_response = json_decode(curl_exec($curl));
            curl_close($curl);
            $temp_token = $token_response{'access_token'};
            $temp_token_expires = $current_time + $token_response{'expires_in'};
           // self::setToken($temp_token, $temp_token_expires);
            setCookie('token', $temp_token);
            setCookie('token_expires', $temp_token_expires);
           // return self::$token;

?>
