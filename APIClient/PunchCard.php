<?php

    class PunchCard {
        private $id;
        private $user;
        private $checkedIn;
        private $tStamp;

        public function __construct($id, $user, $checkedIn, $tStamp){
            $this->id = $id;
            $this->user = $user;
            $this->checkedIn = $checkedIn;
            $this->tStamp = $tStamp;
        }

        public function getID() {
            return $this->id;
        }

        public function getUser() {
            return $this->user_id;
        }

        public function getCheckedIn() {
            return $this->checkedIn;
        }

        public function getTimeStamp() {
            return $this->tStamp;
        }
    }

?>
