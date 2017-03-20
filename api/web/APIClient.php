<?php
    //require_once("APIClient/User.php");

    class APIClient {
        //Singleton-stuff:
        private static $instances = array();
        protected function __construct() {}
        protected function __clone() {}
        public function __wakeup()
        {
            throw new Exception("Cannot unserialize singleton");
        }
        private static function getInstance()
        {
            $cls = get_called_class(); // late-static-bound class name
            if (!isset(self::$instances[$cls])) {
                self::$instances[$cls] = new static;
            }
            return self::$instances[$cls];
        }

        //Actuall interesting code below:

        private static $token;
        private static $token_expires;

        private static function setToken($t_string, $t_expires) {
            self::getInstance()::$token = $t_string;
            self::getInstance()::$token_expires = $t_expires;
        }

        private static function tokenIsValid($ctime) {
            //echo (int) $_COOKIE['token_expires']) . " " . $ctime;
            //$current_time = time() * 1000;
            echo    "Current: " . $ctime . "<br />" .
                    "Expires: " . $_COOKIE['token_expires'] . "<br />";
            if(isset($_COOKIE['token']) && $_COOKIE['token'] != "" && ((int) $_COOKIE['token_expires']) > $ctime) {
                self::setToken($_COOKIE['token'], $_COOKIE['token_expires']);
                return true; // Will do extra checking later...
            }
            return false;
        }

        public static function getAPIHost() {
            $server = "http://" . $_SERVER['SERVER_NAME'] . ":";
            $api_url = $server . "8080";
            return $api_url;
        }

        public static function getToken() {
            date_default_timezone_set("UTC");
            $current_time = time();
            $api_url = self::getAPIHost() . "/Auth/token.php";
            if(!self::tokenIsValid($current_time)) {
                $curl = curl_init();
                $params = array();

                //TODO: change the client username & password
                $params['client_id'] = 'testclient';
                $params['client_secret'] = 'testpass';

                $params['grant_type'] = 'client_credentials';
                curl_setopt($curl, CURLOPT_URL, $api_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                $token_response = json_decode(curl_exec($curl));
                curl_close($curl);
                $temp_token = $token_response->{'access_token'};
                $temp_token_expires = $current_time + $token_response->{'expires_in'};
                self::setToken($temp_token, $temp_token_expires);
                setCookie('token', $temp_token);
                setCookie('token_expires', $temp_token_expires);
            }
            return self::getInstance()::$token;
        }

        public static function APICall($url, $params) {
            //currently just a copy of the call above, will change after testing probably
            $curl = curl_init();
            $url = self::getAPIHost() . $url;

            $params['access_token'] = self::getToken();
            echo $params['access_token'];
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
            return json_decode($response);
        }

        public static function login($username, $password) {
            $params = array();
            $params['username'] = $username;
            $params['password'] = $password;
            self::APICall("/Auth/login.php", $params);
        }

        public static function logout() {
            //really just deletes the token cookie and gets another one...
            setCookie('token', "");
            setCookie('token_expires', "");
            self::getToken();
        }

        public static function tokenInfo() {
            return self::APICall("/Auth/tokenInfo.php", array());
        }

        public static function isLoggedIn(){
            return self::tokenInfo()->{'logged_in'};
        }

        public static function isAdmin(){
            return self::tokenInfo()->{'admin'};
        }

        public static function getAnnouncements($num) {
            //self::APICall(self::getA);
        }
    }
?>
