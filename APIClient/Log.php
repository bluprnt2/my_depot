<?php

    class Log {
        private $id;
        private $user_id;
        private $course_id;
        private $comments;
        private $tStamp;

        public function __construct($id, $user_id, $course_id, $comments, $tStamp){
            $this->id = $id;
            $this->user_id = $user_id;
            $this->course_id = $course_id;
            $this->comments = $comments;
            $this->tStamp = $tStamp;
        }

        public function getID() {
            return $this->id;
        }

        public function getUserID() {
            return $this->user_id;
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
