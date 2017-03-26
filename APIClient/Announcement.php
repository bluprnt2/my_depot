<?php

    class Announcement {
        private $userid;
        private $title;
        private $content;
        private $deptid;
        private $tstamp;

        public function __construct( $userid, $title, $content, $deptid, $tstamp) {
            $this->userid = $userid;
            $this->title = (string) $title;
            $this->content = $content;
            $this->deptid = $deptid;
            $this->tstamp = $tstamp;
        }

        public function getUserID() {
            return $this->userid;
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
