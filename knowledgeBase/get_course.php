<html>
<?php
include "connectiondb.php";
$query= "SELECT DISTINCT course FROM courses WHERE subjectid ='".$_POST["countryid"]."'";

$result=$dbhandle->query($query);

?>
<option>Select Course</option>
<?php
	while($rs=$result->fetch_assoc()){
		?>
			?option value="<?php echo $rs["courseid"]; ?>"><?php echo $rs["courseName"]; ?></option>
		<?php
</html>