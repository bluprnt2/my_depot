<?php

    class Announcement {
        private $user;
        private $title;
        private $content;
        private $deptid;
        private $tstamp;

        public function __construct( $user, $title, $content, $deptid, $tstamp) {
            $this->user = $user;
            $this->title = $title;
            $this->content = $content;
            $this->deptid = $deptid;
            $this->tstamp = $tstamp;
        }

        public function getUser() {
            return $this->user;
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
