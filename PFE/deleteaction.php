<?php 
require "database.php";

$classname=$_GET['Classname'];
$obj=$_GET['Actioname'];
$usser=$_GET['usser'];



$query="DELETE FROM suggestion_action where Username= :usern AND Classname= :cls AND Actionname=:ob";
$requette=$database->prepare($query);
$requette->execute(array(':usern'=>$usser,':cls'=>$classname,':ob'=>$obj));

		echo '<script>
    setTimeout(function() {
        swal({
            title: "Deleted!",
            text: "Your suggestion deleted !! ",
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';
  header("Refresh: 1; URL=tables.php");

?>