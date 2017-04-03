<html>
<?php
include "connectiondb.php";
$query= "SELECT DISTINCT file FROM files WHERE fileid ='".$_POST["courseid"]."'";

$result=$dbhandle->query($query);

?>
<option>Select File</option>
<?php
	while($rs=$result->fetch_assoc()){
		?>
			?option value="<?php echo $rs["fileid"]; ?>"><?php echo $rs["fileName"]; ?></option>
		<?php
</html>