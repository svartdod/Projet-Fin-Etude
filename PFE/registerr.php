<?php 


$_SESSION['username']=$_POST['username'];
$_SESSION['first_name']=$_POST['first_name'];
$_SESSION['Second_name']=$_POST['second_name'];
$_SESSION['Email']=$_POST['email'];
$_SESSION['Institution']=$_POST['insitution']; 
$_SESSION['Confidential_Level']=0;

$password=$_POST['password'];

$query="SELECT FROM * users WHERE USERNAME = :usern"; 
$requette=$database->prepare($query);
$requette->execute(array(':usern'=>$_POST['username'])); 

if( $requette->rowCount() > 0)
{

$_SESSION['message'] = 'this User  already exists!';
    //header("location: index.php");

}

else 

{	
	$query="INSERT INTO users (USERNAME,PASSWORD,EMAIL,FIRST_NAME,SECOND_NAME,Insitution) VALUES (:usern,:pass,:email,:fn,:sn,:insitution)";

	$requette=$database->prepare($query);
	if ($requette->execute(array(':usern'=>$_POST['username'],':pass'=>$_POST['password'],':email'=>$_POST['email'],':fn'=>$_POST['first_name'],':sn'=>$_POST['second_name'],':insitution'=>$_POST['insitution'])))
	{
		$_SESSION['logged_in']=true;

		echo '<script>
    setTimeout(function() {
        swal({
            title: "Wow!",
            text: "GeyGey!",
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';
  header("Refresh: 1; URL=home.php");
	}


	else  
	{
		header("location:index.php");
	}




}


?>