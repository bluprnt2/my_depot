<?php

    class User {
        private $userid;
        private $username;
        private $firstname;
        private $lastname;
        private $admin;
        private $notify;
<<<<<<< HEAD
	private $email;
=======
        private $email;
>>>>>>> 7baef44bf61a4fe1fe08d23dc3cff2d950f9952d

        public function __construct( $userid, $username, $firstname,
                                    $lastname, $admin, $notify, $email) {
            $this->userid = $userid;
            $this->username = $username;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->admin = $admin;
            $this->notify = $notify;
<<<<<<< HEAD
	    $this->email = $email;
=======
            $this->email = $email;
>>>>>>> 7baef44bf61a4fe1fe08d23dc3cff2d950f9952d
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
<<<<<<< HEAD
	public function getEmail() {
	    return $this->email;
	}
=======

        public function getEmail() {
            return $this->email;
        }
>>>>>>> 7baef44bf61a4fe1fe08d23dc3cff2d950f9952d
    }

?>
