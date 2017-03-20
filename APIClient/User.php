<?php

    class User {
        private $id;
        private $username;
        private $firstname;
        private $lastname;
        private $admin;
        private $notify;

        public function _construct( $temp_id, $temp_username, $temp_firstname,
                                    $temp_lastname, $temp_admin, $temp_notify) {
            $id = $temp_id;
            $username = $temp_username;
            $firstname = $temp_firstname;
            $lastname = $temp_lastname;
            $admin = $temp_admin;
            $notify = $temp_notify;
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
