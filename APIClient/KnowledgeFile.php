<?php

    class KnowledgeFile {
        private $id;
        private $courseID;
        private $userID;
        private $filename;
        private $content;
        private $approved;

        public function _construct( $temp_id, $temp_courseID, $temp_userID,
                                    $temp_filename, $temp_content,
                                    $temp_approved) {
            $id = $temp_id;
            $courseID = $temp_courseID;
            $userID = $temp_userID;
            $filename = $temp_filename;
            $content = $temp_content;
            $approved = $temp_approved;
        }

        public function getID() {
            return $id;
        }

        public function getCourseID() {
            return $courseID;
        }

        public function getUserID() {
            return $userID;
        }

        public function getFilename() {
            return $filename;
        }

        public function getContent() {
            return $content;
        }

        public function getApproved() {
            return $approved;
        }
    }

?>
