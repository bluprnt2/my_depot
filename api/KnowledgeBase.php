<?php

	function getFiles($id, $courseID, $fileName, $tutorserver)
	{
		$query = "SELECT * FROM KnowledgeFiles WHERE
			ID=COALESCE(?, ID) AND
			courseID=COALESCE(?, courseID) AND
			fileName=COALESCE(?, fileName)";

		$files = array();
		if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iis', $id, $courseID, $fileName);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $files[] = $a;
            }
            $stmnt->close();
            return $files;
        }
    }

	function addFile($courseID, $userID, $fileName, $content, $tutorserver)
	{
		$query = "INSERT INTO KnowledgeFiles (courseID, userID, fileName, content) VALUES (?, ?, ?, ?)";
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

	function setFile($fileID, $courseID, $userID, $fileName, $content, $approved, $tutorserver){
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

	function removeFile($userID, $fileID, $tutorserver)
	{
		$query = "DELETE FROM KnowledgeFiles WHERE ID=? AND userID=?";

		if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $fileID, $userID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
	}
?>
