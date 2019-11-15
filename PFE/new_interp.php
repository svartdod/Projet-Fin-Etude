<?php 

require "CLASS.php";

function Generate_triplet($database,$objects,$actions,$actors)

{

	$acotrs=explode(",",$actors);
	$action=explode(",", $actions);
	$objects=explode(",", $objects);
	
	$verbtransai = array(); 
	$verb_non_transi=array();
	$i=0;
	$j=0;
	foreach($acotrs as $ac)
	{	$a=$ac;

		foreach ($action as $act)
		{
			$b=$a.",".$act;

			$verbtransai[$i]=$b;
			$i++;
			foreach($objects as $obj)
				{ 	
					$c=$b.",".$obj;
					$verb_non_transi[$j]=$c;
					$j++;


				}
		}
	}

//return [$verb_non_transi, $verbtransai];
	return $verb_non_transi;
}

function only_correct_triplet_transi($database,$array1,$classs)
{		

	$array_final=array();
	$best=array();
	$poid=array();
	$i=0;
	$query="SELECT * from interactions where Classname=:cls and Actorname=:act and Actionname=:acts and Objectname=:obj";
	$resultat=$database->prepare($query);

	foreach ($array1 as $triplet)
	{	
		$element=explode(",", $triplet);
		
		$resultat->execute(array(':cls'=>$classs,
		':act'=>$element[0],
		':acts'=>$element[1],
		':obj'=>$element[2]));

		while($row=$resultat->fetch(PDO::FETCH_ASSOC))
			{

				$array_final[$i]=$row['Classname'].",".$row['Actorname'].",".$row['Actionname'].",".$row['Objectname'].",".$row['PP'];
				$poid[$i]=$row['Poid'];
				$i++;



			}





	}
	if(sizeof($poid)>3)
	{
		$max=3;
	}
	else 
	{
		$max=sizeof($poid);
	}
	$j=0;
	while ($j<$max)
	{
		$value = max($poid);
		$key = array_search($value, $poid);
		$best[$j]=$array_final[$key];
		array_splice($poid, $key, 1);
		array_splice($array_final, $key, 1);
		$j++;
	}

	return $best;
}

function check($array1)


{
if(sizeof($array1)==0) return "sing";
$best_one_baby=$array1[0];
$output = array_slice($array1, 1);

if (in_array($best_one_baby, $output))

{ 
	return "plural";

}

return "sing";


}

function create_pluar_sentence($element)
{
	// form of sentences NP-VP-PP 

			$NP ="There's";
	
			$second_array=explode(",", $element);
			
			$req="python2 plural.py ".$second_array[1];
			
			$actor= shell_exec($req);
			
			$NP=$NP." ".$actor;
			$chaine="python2 conjugate.py ".$second_array[2];
			
			$VP= shell_exec($chaine);
			
			$VP=" ".$VP;
			$PP=$second_array[4]." ".$second_array[3];

			$sentences=$NP." ".$VP." ".$PP." in ".$second_array[0];
			
			
			 $GLOBALS['a']=$NP." ".$VP;

			 $GLOBALS['b']=$PP." in ".$second_array[0];




 return $sentences;
}

function create_sentences($element)
{
	// form of sentences NP-VP-PP 

			$dit=array("There's","Here is","We have","This is");
			$randIndex = array_rand($dit);
			$gg=$dit[$randIndex];
			$NP =$gg;
	
			$second_array=explode(",", $element);
			
			$NP=$NP." ".$second_array[1];
			$chaine="python2 conjugate.py ".$second_array[2];
			
			$VP= shell_exec($chaine);
			
			$VP=" ".$VP;
			$PP=$second_array[4]." ".$second_array[3];

			$sentences=$NP." ".$VP." ".$PP." in ".$second_array[0];
			
			
			 $GLOBALS['a']=$NP." ".$VP;

			 $GLOBALS['b']=$PP." in ".$second_array[0];




 return $sentences;
}

function interpretation_final($database)
{
	$classs=Classification_interpretation();
	$classs=(string) substr ($classs,2,strlen($classs)-5);
	$resultat=Generate_triplet($database,$_POST['object15'],$_POST['action15'],$_POST['acteur15']);
	$resultat2= only_correct_triplet_transi($database,$resultat,$classs);
	$resultat_final="";
	if (check($resultat2)=="plural")
	{
		$resultat_final=$resultat_final.",".create_pluar_sentence($resultat2[0]);

	}
	if (sizeof($resultat2)<2 && sizeof($resultat2)>0)
	{
		$resultat_final=$resultat_final.",".create_sentences($resultat2[0]);

	}
	if(sizeof($resultat2)>=2)
	{
				$resultat_final=$resultat_final.",".create_sentences($resultat2[0]);

				$resultat_final=$resultat_final.",".create_sentences($resultat2[1]);


	}

	if(sizeof($resultat2)==0)
	{
		
		$actors=$_POST['acteur15'];

		$new_traitement=$classs;
	$se9sini=$new_traitement."_".$actors;
	$chaine1="python3 interp.py ".(string)$se9sini;

	
	$resultat1=shell_exec($chaine1);

	$gg=$resultat1;
	$_POST['acteur15']=$gg;
	$a=Generate_triplet($database,$_POST['object15'],$_POST['action15'],$_POST['acteur15']);
	$V=joke($database,$a,$classs);
	if(!empty($V))

{	$c=create_sentences2($V[0],$actors);
	$resultat_final=$resultat_final.",".create_sentences2($V[0],$actors);

	$maxx=strlen($c);

	  
}

$resultat_final=$resultat_final.","."We are in ".$classs." and there's here ".$_POST['object15'];

	}
   $_SESSION['message1']=$resultat_final;
	   $_SESSION['message1']=str_replace("\n","",$_SESSION['message1']);
	   echo '<script>
    setTimeout(function() {
        swal({
            title: "Wow!",
            text:"'.$_SESSION['message1'].'",
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';
}

function create_sentences2($element,$actor)
{
	// form of sentences NP-VP-PP 
	$dit=array("There's","Here is","We have","This is");
			$randIndex = array_rand($dit);
			$gg=$dit[$randIndex];
			$NP =$gg;

			
	
			$second_array=explode(",", $element);
			
			$NP=$NP." ".$actor;
			$chaine="python2 conjugate.py ".$second_array[2];
			
			$VP= shell_exec($chaine);
			
			$VP=" ".$VP;
			$PP=$second_array[4]." ".$second_array[3];

			$sentences=$NP." ".$VP." ".$PP." in ".$second_array[0];
			
			
			 $GLOBALS['a']=$NP." ".$VP;

			 $GLOBALS['b']=$PP." in ".$second_array[0];




 return $sentences;
}

function joke($database,$array1,$classs)
{	
	$array_final=array();
	$best=array();
	$poid=array();
	$i=0;
	$query1="SELECT * from interactions where Classname=:cls and Actorname=:act and Actionname=:acts and Objectname=:obj";
	$resultat=$database->prepare($query1);

	foreach ($array1 as $triplet)
	{	
		$element=explode(",", $triplet);
		
		$bb= substr($element[0], 0, strlen($element[0])-1);

		$resultat->execute(array(':cls'=>$classs,':act'=>$bb,':acts'=>$element[1],':obj'=>$element[2]));

		

		while($row=$resultat->fetch(PDO::FETCH_ASSOC))
			{

				$array_final[$i]=$row['Classname'].",".$row['Actorname'].",".$row['Actionname'].",".$row['Objectname'].",".$row['PP'];
				$poid[$i]=$row['Poid'];
				$i++;


			}



	}

	if(sizeof($poid)>3)
	{
		$max=3;
	}
	else 
	{
		$max=sizeof($poid);
	}
	$j=0;
	while ($j<$max)
	{
		$value = max($poid);
		$key = array_search($value, $poid);
		$best[$j]=$array_final[$key];
		array_splice($poid, $key, 1);
		array_splice($array_final, $key, 1);
		$j++;



	}

	return $best;



}

?>