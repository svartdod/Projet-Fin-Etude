<?php 


if(!empty($_POST['otherr']))
	{
		$_POST['Action']=$_POST['otherr'];
	} 

$query="SELECT * FROM action_in_superclass where Classname =:cls AND Actionname=:obn";
$requette= $database->prepare($query);

$requette->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Action']));

if($requette->rowCount()==0)
{
	$query="SELECT * FROM suggestion_action where Classname =:cls AND Actorname=:obn AND Username=:usern";
	$requette= $database->prepare($query);

	$requette->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Action'],'usern'=>$_SESSION['username']));



if($requette->rowCount()==0)

{	if($_POST['Poid']==="Very_Frequent") 
		{
			$poid=rand ( 80, 100 );
		} 
		elseif ($_POST['Poid']==="Frequent")
			{
				$poid=rand ( 60 , 79);
			}
			else 
			{
				$poid=rand ( 30 , 59 );
			}

	$query2="INSERT INTO suggestion_action (Username,Classname,Actionname,Poid) VALUES (:usern,:cls,:obn,:poid)";

	$requette2=$database->prepare($query2);
	if ($requette2->execute(array(':usern'=>$_SESSION['username'],':cls'=>$_POST['Superclass'],':obn'=>$_POST['Action'],':poid'=>$poid)))
		{	
			echo '<script>
    setTimeout(function() {
        swal({
            title: "Bravo!",
            text: "Thank you for your suggestion!",
            type: "success"
        }, function() {
            window.location.href = "forms.php";
        });
    }, 1000);
</script>';

			$Query_sugg="SELECT * FROM suggestion_action where     Classname=:cls AND Actionname=:obn";
			$resultat_sugg=$database->prepare($Query_sugg);
			$resultat_sugg->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Action']));
			if($resultat_sugg->rowCount()==2)
			{
			$add_in_obs="INSERT INTO action_in_superclass (Classname,Actionname,poid) VALUES (:cls,:obn,:poid)";
			$resultat_add=$database->prepare($add_in_obs);

			if ($resultat_add->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Action'],':poid'=>5)))
				{
					$Query_update="UPDATE suggestion_action SET Statu=:stt WHERE Classname=:cls AND Actionname=:obn";
					$resultat_update=$database->prepare($Query_update);
					$resultat_update->execute(array(':stt'=>'True',':cls'=>$_POST['Superclass'],'obn'=>$_POST['Action']));
	

				$user_update="UPDATE users U,suggestion_action S SET COND_LVL=COND_LVL+:adds where S.Classname=:cls AND S.Actionname=:obn AND U.USERNAME=S.Username"
					;
					$resut=$database->prepare($user_update);
					$resut->execute(array(':adds'=>3,':cls'=>$_POST['Superclass'],'obn'=>$_POST['Action']));
					

				}



				}

		
				header("Refresh: 2; URL=action.php");

		}




		else 
		{
		}


}

else
{		echo '<script>
    setTimeout(function() {
        swal({
            title: "Error!",
            text: "This Suggestion exists already!",
            type: "error"
        }, function() {
            window.location.href = "action.php";
        });
    }, 1000);
</script>';
  header("Refresh: 2; URL=action.php");

}

}

else 
{



	echo '<script>
    setTimeout(function() {
        swal({
            title: "Error!",
            text: "This Action exists already!",
            type: "error"
        }, function() {
            window.location.href = "action.php";
        });
    }, 1000);
</script>';
  header("Refresh: 2; URL=action.php");

}






?>