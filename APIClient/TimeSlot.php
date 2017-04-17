<?php

    class TimeSlot {
        private $id;
        private $location_id;
        private $department_id;
        private $course_id;
        private $startTime;
        private $endTime;

        public function __construct($id, $location_id, $department_id, $course_id,
                                    $startTime, $endTime){
            $this->id = $id;
            $this->location_id = $location_id;
            $this->course_id = $course_id;
            $this->department_id = $department_id;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
        }

        public function getID() {
            return $this->id;
        }

        public function getLocationID() {
            return $this->location_id;
        }

        public function getDepartmentID() {
            return $this->department_id;
        }

        public function getCourseID() {
            return $this->course_id;
        }

        public function getStartTime() {
            return $this->startTime;
        }

        public function getEndTime() {
            return $this->endTime;
        }
    }

?>
