<?php

    class PunchCard {
        private $id;
        private $user_id;
        private $checkedIn;
        private $tStamp;

        public function __construct($id, $user_id, $checkedIn, $tStamp){
            $this->id = $id;
            $this->user_id = $user_id;
            $this->checkedIn = $checkedIn;
            $this->tStamp = $tStamp;
        }

        public function getID() {
            return $this->id;
        }

        public function getUserID() {
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
