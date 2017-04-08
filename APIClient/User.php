<?php

    class User {
        private $userid;
        private $username;
        private $firstname;
        private $lastname;
        private $admin;
        private $notify;

        public function __construct( $userid, $username, $firstname,
                                    $lastname, $admin, $notify) {
            $this->userid = $userid;
            $this->username = $username;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->admin = $admin;
            $this->notify = $notify;
        }

        public function getUserID() {
            return $this->userid;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getFirstName() {
            return $this->firstname;
        }

        public function getLastName() {
            return $this->lastname;
        }

        public function getAdmin() {
            return $this->admin;
        }

        public function getNotify() {
            return $this->notify;
        }
    }

?>
