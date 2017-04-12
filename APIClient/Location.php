<?php

    class Location {
        private $id;
        private $buildingName;
        private $roomNumber;

        public function __construct($id, $buildingName, $roomNumber){
            $this->id = $id;
            $this->buildingName = $buildingName;
            $this->roomNumber = $roomNumber;
        }

        public function getID() {
            return $this->id;
        }

        public function getBuildingName() {
            return $this->buildingName;
        }

        public function getRoomNumber() {
            return $this->roomNumber;
        }
    }

?>
