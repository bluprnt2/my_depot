<?php

    class User {
        private $id;
        private $username;
        private $firstname;
        private $lastname;
        private $admin;
        private $notify;

        public function _construct($user_id, $mysql_server) {
        }

        public function getID() {
            return $id;
        }

        public function getUsername() {
            return $username;
        }

        public function getFirstName() {
            return $firstname;
        }

        public function getLastName() {
            return $lastname;
        }

        public function getAdmin() {
            return $admin;
        }

        public function getNotify() {
            return $notify;
        }
    }

?>
