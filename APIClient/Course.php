<?php
    class Course {
        private $id;
        private $courseName;
        private $deptID;
        public function _construct( $temp_id, $temp_courseName, $temp_userID) {
            $id = $temp_id;
            $courseID = $temp_courseName;
            $userID = $temp_userID;
        }
        public function getID() {
            return $id;
        }
        public function getCourseName() {
            return $courseID;
        }
        public function getDeptID() {
            return $userID;
        }
    }
?>