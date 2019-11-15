<?php
require "database.php";

if($_POST['id'])
{
	$id=$_POST['id'];
		
	$stmt = $database->prepare("SELECT * FROM superclass WHERE Classname=:id");
	$stmt->execute(array(':id' => $id));
	?><option selected="selected">Select State :</option><?php
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
        <option value="<?php echo $row['Classname']; ?>"><?php echo $row['Classname']; ?></option>
        <?php
	}
}
?>