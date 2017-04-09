<?php
    require_once("APIClient/Announcement.php");
    require_once("APIClient/User.php");
    require_once("APIClient/PunchCard.php");
    require_once("APIClient/Department.php");
    require_once("APIClient/Course.php");

    //Not Tested
    require_once("APIClient/Log.php");

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

        //Tested
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

        //Tested
        public static function getAPIHost() {
            $server = "http://" . $_SERVER['SERVER_NAME'] . ":";
            $api_url = $server . "8080";
            return $api_url;
        }

        //Tested
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

        //Tested
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

        //Tested
        public static function login($username, $password) {
            $params = array();
            $params['username'] = $username;
            $params['password'] = $password;
            self::APICall("/Auth/login.php", $params);
        }

        //Tested
        public static function logout() {
            //really just deletes the token cookie and gets another one...
            setCookie('token', "");
            setCookie('token_expires', "");
            self::getToken();
        }

        //Tested
        public static function getUser($id) {
            $params = array();
            $params['userid'] = $id;
            $user_array = self::APICall("/Users/get.php", $params);
            $users = array();
            foreach($user_array as $u) {
                $users[] = new User(
                    $u->{'ID'},
                    $u->{'userName'},
                    $u->{'firstName'},
                    $u->{'lastName'},
                    $u->{'admin'},
                    $u->{'notify'}
                );
            }
            if($id != null) return $users[0];
            return $users;
        }

        //Tested
        public static function tokenInfo() {
            return self::APICall("/Auth/tokenInfo.php", array());
        }

        //Tested
        public static function getCurrentUser() {
            return self::getUser(self::tokenInfo()->{'userID'});
        }

        //Tested
        public static function isLoggedIn(){
            return self::tokenInfo()->{'logged_in'};
        }

        //Tested
        public static function isAdmin(){
            return self::tokenInfo()->{'admin'};
        }

        //Tested
        public static function getAnnouncements($num) {
            $params = array();
            $params['amount'] = $num;
            $json_array = self::APICall("/Announcements/get.php", $params);
            $announcements = array();
            foreach($json_array as $item) {
                $announcements[] = new Announcement(
                    $item->{'userID'},
                    $item->{'title'},
                    $item->{'content'},
                    $item->{'deptID'},
                    $item->{'tStamp'}
                );
            }
            return $announcements;
        }

        //Tested
        public static function addAnnouncement($announcement) {
            $params = array();
            $params['title'] = $announcement->getTitle();
            $params['content'] = $announcement->getContent();
            $params['deptID'] = $announcement->getDepartmentID();
            $json_array = self::APICall("/Announcements/add.php", $params);
        }

        //Tested
        public static function addLog($log) {
            $params = array();
            $params['userID']   = $log->getUserID();
            $params['courseID'] = $log->getCourseID();
            $params['comments'] = $log->getComments();
            $json_array = self::APICall("/Logs/add.php", $params);
        }

        //Tested
        public static function getLogs($logID, $user, $course, $startTime, $endTime) {
            $params = array();
            $params['logID'] = $logID;
            $params['startTime'] = $startTime;
            $params['endTime'] = $endTime;
            if($user != NULL) $params['userID'] = $user->getID();
            if($course != NULL) $params['courseID'] = $course->getID();
            $json_array = self::APICall("/Logs/get.php", $params);
            $logs = array();
            foreach($json_array as $item) {
                $logs[] = new Log(
                    $item->{'ID'},
                    $item->{'userID'},
                    $item->{'courseID'},
                    $item->{'comments'},
                    $item->{'tStamp'}
                );
            }
            return $logs;
        }

        //Tested
        public static function toggleCheckedIn($userid) {
            if($userid != NULL) {
                $params = array();
                $params['userID'] = $userid;
                $json_array = self::APICall("/PunchCards/toggleCheckedIn.php", $params);
            } else return false;
        }

        //Tested
        public static function getCheckedIn($userid) {
            if($userid != NULL) {
                $params = array();
                $params['userID'] = $userid;
                $json_array = self::APICall("/PunchCards/getCheckedIn.php", $params);
                return (bool) $json_array;
            } else return false;
        }

        //Tested
        public static function getPunchCards($punchcardID, $userid, $checkedIn, $startTime, $endTime) {
            $params = array();
            $params['userID'] = $userid;
            $params['punchcardID'] = $punchcardID;
            $params['checkedIn'] = $checkedIn;
            $params['startTime'] = $startTime;
            $params['endTime'] = $endTime;
            $json_array = self::APICall("/PunchCards/get.php", $params);
            $punchcards = array();
            foreach($json_array as $item) {
                $punchcards[] = new PunchCard(
                    $item->{'ID'},
                    $item->{'userID'},
                    $item->{'checkedIn'},
                    $item->{'tStamp'}
                );
            }
            return $punchcards;
        }

        //Tested
        public static function addCourse($course) {
            if($course != NULL) {
                $params = array();
                $params['courseName'] = $course->getName();
                $params['deptID'] = $course->getDeptID();
                $json_array = self::APICall("/Courses/add.php", $params);
            } else return false;
        }

        //Tested
        public static function getCourses($courseID, $deptID) {
            $params = array();
            $params['courseID'] = $courseID;
            $params['deptID'] = $deptID;
            $json_array = self::APICall("/Courses/get.php", $params);
            $courses = array();
            foreach($json_array as $item) {
                $courses[] = new Course(
                    $item->{'ID'},
                    $item->{'courseName'},
                    $item->{'deptID'}
                );
            }
            return $courses;
        }

        //Tested
        public static function getDepartments($deptID) {
            $params = array();
            $params['deptID'] = $deptID;
            $json_array = self::APICall("/Departments/get.php", $params);
            $departments = array();
            foreach($json_array as $item) {
                $departments[] = new Department(
                    $item->{'ID'},
                    $item->{'deptName'}
                );
            }
            if($deptID != NULL) return $departments[0];
            return $departments;
        }

        //Tested
        public static function addDepartment($department) {
            if($department != NULL) {
                $params = array();
                $params['deptName'] = $department->getName();
                $json_array = self::APICall("/Departments/add.php", $params);
            } else return false;
        }
    }
?>
