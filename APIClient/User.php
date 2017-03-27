<?php

    class User {
        private $username;
        private $firstname;
        private $lastname;
        private $admin;
        private $notify;

        public function __construct( $username, $firstname,
                                    $lastname, $admin, $notify) {
            $this->username = $username;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->admin = $admin;
            $this->notify = $notify;
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
