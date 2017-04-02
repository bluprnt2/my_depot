<?php

    class Log {
        private $id;
        private $user;
        private $course_id;
        private $comments;
        private $tStamp;

        public function __construct($id, $user, $course_id, $comments, $tStamp){
            $this->id = $id;
            $this->user = $user;
            $this->course_id = $course_id;
            $this->comments = $comments;
            $this->tStamp = $tStamp;
        }

        public function getID() {
            return $this->id;
        }

        public function getUser() {
            return $this->user;
        }

        public function getCourseID() {
            return $this->course_id;
        }

        public function getComments() {
            return $this->comments;
        }

        public function getTimeStamp() {
            return $this->tStamp;
        }
    }

?>
