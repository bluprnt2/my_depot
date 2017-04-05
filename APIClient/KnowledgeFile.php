<?php

    class KnowledgeFile {
        private $id;
        private $courseID;
        private $userID;
        private $filename;
        private $content;
        private $approved;

        public function _construct( $id, $courseID, $userID,
                                    $filename, $content,
                                    $approved) {
            $this->id = $id;
            $this->courseID = $courseID;
            $this->userID = $userID;
            $this->filename = $filename;
            $this->content = $content;
            $this->approved = $approved;
        }

        public function getID() {
            return $this->id;
        }

        public function getCourseID() {
            return $this->courseID;
        }

        public function getUserID() {
            return $this->userID;
        }

        public function getFilename() {
            return $this->filename;
        }

        public function getContent() {
            return $this->content;
        }

        public function getApproved() {
            return $this->approved;
        }
    }

?>
