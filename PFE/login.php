<?php 


if(!empty($_POST['username']) && !empty($_POST['password']))
{	
	$username=$_POST['username'];
	$query="SELECT * FROM users WHERE USERNAME=:usern";
	$resultat=$database->prepare($query);
	$resultat->execute(array(':usern'=>$username));
	if($resultat->rowCount()==0)
		{

		$_SESSION['Message']="That username doesn't exist";
		echo '<script>
    setTimeout(function() {
        swal({
            title: "Oups!",
            text: "That username doesnt exist!",
            type: "error"
        }, function() {
            window.location.href = "ss.php";
        });
    }, 1000);
</script>';

  
	  header("Refresh: 2; URL=index.php");

		}
	else 
	{	
		$user=$resultat->fetch(PDO::FETCH_ASSOC);
		if($_POST['password']==$user['PASSWORD'])
		{

			$_SESSION['username']=$user['USERNAME'];
			$_SESSION['first_name']=$user['FIRST_NAME'];
			$_SESSION['Second_name']=$user['SECOND_NAME'];
			$_SESSION['Email']=$user['EMAIL'];
			$_SESSION['Institution']=$user['Insitution'];
			$_SESSION['Confidential_Level']=$user['COND_LVL'];
			$_SESSION['logged_in']=true;


 // header("Refresh: 3; URL=home.php");
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
		else {
 	//	$_SESSION['message'] = "You have entered wrong password, try again!";
        //header("location: index.php");	
			echo '<script>
    setTimeout(function() {
        swal({
            title: "Oups!",
            text: "You have entered wrong password, try again!!",
            type: "error"
        }, function() {
            window.location.href = "ss.php";
        });
    }, 1000);
</script>';

  
	  header("Refresh: 2; URL=index.php");




        }



	}


}

