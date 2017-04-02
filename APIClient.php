<?php
    require_once("APIClient/Announcement.php");
    require_once("APIClient/User.php");

    //Not Tested
    require_once("APIClient/Course.php");
    require_once("APIClient/Log.php");
    require_once("APIClient/PunchCard.php");

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
            /*echo    "Current: " . $ctime . "<br />" .
                    "Expires: " . $_COOKIE['token_expires'] . "<br />";
            */if(isset($_COOKIE['token']) && $_COOKIE['token'] != "" && ((int) $_COOKIE['token_expires']) > $ctime) {
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
            //echo $params['access_token'];
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));

            $response = curl_exec($curl);
            curl_close($curl);
            //echo $response;
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

        public static function getUser($id) {
            $params = array();
            $params['userid'] = $id;
            $user_array = self::APICall("/Users/get.php", $params);
            $user = new User(
                $user_array->{'userName'},
                $user_array->{'firstName'},
                $user_array->{'lastName'},
                $user_array->{'admin'},
                $user_array->{'notify'}
            );
            return $user;
        }

        public static function tokenInfo() {
            return self::APICall("/Auth/tokenInfo.php", array());
        }

        public static function getCurrentUser() {
            return self::getUser(self::tokenInfo()->{'userID'});
        }

        public static function isLoggedIn(){
            return self::tokenInfo()->{'logged_in'};
        }

        public static function isAdmin(){
            return self::tokenInfo()->{'admin'};
        }

        public static function getAnnouncements($num) {
            $params = array();
            $params['amount'] = $num;
            $json_array = self::APICall("/Announcements/get.php", $params);
            $announcements = array();
            foreach($json_array as $item) {
                $announcements[] = new Announcement(
                    self::getUser($item->{'userID'}),
                    $item->{'title'},
                    $item->{'content'},
                    $item->{'deptID'},
                    $item->{'tStamp'}
                );
            }
            return $announcements;
        }

        public static function addAnnouncement($announcement) {
            $params = array();
            $params['title'] = $announcement->getTitle();
            $params['content'] = $announcement->getContent();
            $params['deptID'] = $announcement->getDepartmentID();
            $json_array = self::APICall("/Announcements/add.php", $params);
        }

        //Not Tested
        public static function addLog($log) {
            $params = array();
            $params['courseID'] = $log->getCourseID();
            $params['comments'] = $log->getComments();
            $json_array = self::APICall("/Announcements/add.php", $params);
        }

        //Not Tested
        public static function getLogs($logID, $user, $course, $startTime, $endTime) {
            $params = array();
            $params['logID'] = $logID;
            $params['startTime'] = $startTime;
            $params['endTime'] = $endTime;
            if($user != NULL) $params['userID'] = $user->getID();
            if($course != NULL) $params['courseID'] = $course->getID();
            $json_array = self::APICall("Logs/getCheckedIn", $params);
            $logs = array();
            foreach($json_array as $item) {
                $logs[] = new Log(
                    $item->{'ID'},
                    self::getUser($item->{'userID'}),
                    $item->{'courseID'},
                    $item->{'comments'},
                    $item->{'tStamp'}
                );
            }
            return $logs;
        }

        //Not Tested
        public static function toggleCheckedIn($user) {
            if($user != NULL) {
                $params = array();
                $params['userID'] = $user->getID();
                $json_array = self::APICall("PunchCards/toggleCheckedIn", $params);
            } else return false;
        }

        //Not Tested
        public static function getCheckedIn($user) {
            if($user != NULL) {
                $params = array();
                $params['userID'] = $user->getID();
                $json_array = self::APICall("PunchCards/getCheckedIn", $params);
                //Gonna need to check on this... It seems wrong to me.
                return $json_array->{'checkedIn'};
            } else return false;
        }

        //Not Tested
        public static function getPunchCards($user, $checkedIn, $startTime, $endTime) {
            $params = array();
            if($user != NULL) $params['userID'] = $user->getID();
            $params['checkedIn'] = $checkedIn;
            $params['startTime'] = $startTime;
            $params['endTime'] = $endTime;
            $json_array = self::APICall("PunchCards/get", $params);
            $punchcards = array();
            foreach($json_array as $item) {
                $punchcards[] = new PunchCard(
                    $item->{'ID'},
                    self::getUser($item->{'userID'}),
                    $item->{'checkedIn'},
                    $item->{'tStamp'}
                );
            }
            return $punchcards;
        }
    }
?>
