<?php 

if(!empty($_POST['otherr']))
	{
		$_POST['Object']=$_POST['otherr'];
	}


$query="SELECT * FROM object_in_superclass where Classname =:cls AND Objectname=:obn";
$requette= $database->prepare($query);

$requette->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Object']));

if($requette->rowCount()==0)
{
	$query="SELECT * FROM suggestion_object where Classname =:cls AND Objectname=:obn AND Username=:usern";
	$requette= $database->prepare($query);

	$requette->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Object'],'usern'=>$_SESSION['username']));




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

	$query2="INSERT INTO suggestion_object (Username,Classname,Objectname,Poid) VALUES (:usern,:cls,:obn,:poid)";

	$requette2=$database->prepare($query2);
	if ($requette2->execute(array(':usern'=>$_SESSION['username'],':cls'=>$_POST['Superclass'],':obn'=>$_POST['Object'],':poid'=>$poid)))
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
  

			$Query_sugg="SELECT * FROM suggestion_object where     Classname=:cls AND Objectname=:obn";
			$resultat_sugg=$database->prepare($Query_sugg);
			$resultat_sugg->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Object']));
			if($resultat_sugg->rowCount()==2)
			{
			$add_in_obs="INSERT INTO object_in_superclass (Classname,Objectname,poid) VALUES (:cls,:obn,:poid)";
			$resultat_add=$database->prepare($add_in_obs);

			$moye="SELECT AVG(POID) from suggestion_object where  Classname=:cls AND Objectname=:obn";
			$mo=$database->prepare($moye);

			$mo->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Object']));

			 while($row=$mo->fetch(PDO::FETCH_ASSOC))
			 	{
			 		$gg= $row['AVG(POID)'];
			 	}

			if ($resultat_add->execute(array(':cls'=>$_POST['Superclass'],':obn'=>$_POST['Object'],':poid'=>$gg)))
				{
					$Query_update="UPDATE suggestion_object SET Statu=:stt WHERE Classname=:cls AND Objectname=:obn";
					$resultat_update=$database->prepare($Query_update);
					$resultat_update->execute(array(':stt'=>'True',':cls'=>$_POST['Superclass'],'obn'=>$_POST['Object']));

					$user_update="UPDATE users U,suggestion_object S SET COND_LVL=COND_LVL+:adds where S.Classname=:cls AND S.Objectname=:obn AND U.USERNAME=S.Username"
					;
					$resut=$database->prepare($user_update);
					$resut->execute(array(':adds'=>5,':cls'=>$_POST['Superclass'],'obn'=>$_POST['Object']));


					

				}



				}

		

				header("Refresh: 2; URL=forms.php");
		}




		else 
		{
		}


}

else
{			echo '<script>
    setTimeout(function() {
        swal({
            title: "Error!",
            text: "This Suggestion exists already!",
            type: "error"
        }, function() {
            window.location.href = "forms.php";
        });
    }, 1000);
</script>';
  header("Refresh: 2; URL=forms.php");
}

}

else 
{
	echo '<script>
    setTimeout(function() {
        swal({
            title: "Error!",
            text: "This Object exists already!",
            type: "error"
        }, function() {
            window.location.href = "forms.php";
        });
    }, 1000);
</script>';
  header("Refresh: 2; URL=forms.php");



}






?>