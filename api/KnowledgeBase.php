<?php

	public static function getFiles($courseID, $fileName) 
	{
		$query = "SELECT * FROM KnowledgeFiles WHERE 
			courseID=COALESCE(?, courseID) AND
			fileName=COALESCE(?, fileName)";
        
		$files = array();
		if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('is', $courseID, $fileName);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $files[] = $a;
            }
            $stmnt->close();
            return $files;
        }
    }
	
	public static function addFile($courseID, $userID, $fileName, $content, $tutorserver)
	{
		$query = "INSERT INTO KnowledgeFiles (courseID, userID, fileName, content) VALUES (?, ?)";
		//for each ? bind parameter as seen below
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiss',
                $courseID,
                $userID,
				$fileName,
				$content
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
	}
	
	public static function setFile($fileID, $courseID, $userID, $fileName, $content, $approved){
        $query = "UPDATE KnowledgeFiles SET
            courseID    =COALESCE(?, courseID),
            userID   =COALESCE(?, userID),
            fileName =COALESCE(?, fileName),
            content=COALESCE(?, content),
            approved  =COALESCE(?, approved)
        WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiissi', $courseID, $userID, $fileName, $content, $approved, $fileID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
	}
	
	public static function removeFile($fileID)
	{
		$query = "DELETE FROM KnowledgeFiles WHERE ID=?";
		
		if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $fileID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
	}
?>