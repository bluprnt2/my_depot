<?php
    class Course {
        private $id;
        private $courseName;
        private $deptID;

        public function __construct( $id, $courseName, $deptID) {
            $this->id = $id;
            $this->courseName = $courseName;
            $this->deptID = $deptID;
        }
        public function getID() {
            return $this->id;
        }
        public function getName() {
            return $this->courseName;
        }
        public function getDeptID() {
            return $this->deptID;
        }
    }
?>
