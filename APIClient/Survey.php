<?php

    class Survey {
        private $id;
        private $course_id;
        private $tutor_id;
        private $rating;
        private $title;
        private $comment;
        private $viewed;

        public function __construct($id, $course_id, $tutor_id, $rating, $title, $comment, $viewd){
            $this->id = $id;
            $this->course_id = $course_id;
            $this->tutor_id = $tutor_id;
            $this->rating = $rating;
            $this->title = $title;
            $this->comment = $comment;
            $this->viewed = $viewed;
        }

        public function getID() {
            return $this->id;
        }

        public function getCourseID() {
            return $this->course_id;
        }

        public function getTutorID() {
            return $this->tutor_id;
        }

        public function getRating() {
            return $this->rating;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getComment() {
            return $this->comment;
        }

        public function getViewed() {
            return $this->viewed;
        }
    }

?>
