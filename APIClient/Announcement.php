<?php

    class Announcement {
        private $user_id;
        private $title;
        private $content;
        private $deptid;
        private $tstamp;

        public function __construct( $user_id, $title, $content, $deptid, $tstamp) {
            $this->user_id = $user_id;
            $this->title = $title;
            $this->content = $content;
            $this->deptid = $deptid;
            $this->tstamp = $tstamp;
        }

        public function getUserID() {
            return $this->user_id;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getContent() {
            return $this->content;
        }

        public function getDepartmentID() {
            return $this->deptid;
        }

        public function getTimestamp() {
            return $this->tstamp;
        }
    }

?>
