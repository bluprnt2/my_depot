<?php

    class Department {
        private $id;
        private $name;

        public function _construct($temp_id, $temp_name){
            $id =   $temp_id;
            $name = $temp_name;
        }

        public function getID() {
            return $id;
        }

        public function getName() {
            return $name;
        }
    }

?>
