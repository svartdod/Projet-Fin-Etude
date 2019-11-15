<?php 
include "classe.php";
function get_all_triplet($database)

{


	$actors=$_POST['ACTS'];
	$actions=$_POST['actionss'];
	$objects=$_POST['txtScript'];
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
function create_sentences($element)
{
	// form of sentences NP-VP-PP 

			$NP ="There's";
	
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

function create_sentences2($element,$actor)
{
	// form of sentences NP-VP-PP 

			$NP ="There's";
	
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

function interp($database)
{
	$classs=for_inter();
	$classs=(string) substr ($classs,2,strlen($classs)-5);

$V=only_correct_triplet_transi($database,get_all_triplet($database),$classs);
if(!empty($V))

{	$c=create_sentences($V[0]);
	$maxx=strlen($c);

	   $_SESSION['message1']=$c;
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
echo create_sentences($V[0]);
}
else 
{	

	
	$resultat="This is a ".$classs;
		
echo '<script>
    setTimeout(function() {
        swal({
            title: "Wow!",
            text:"'.$resultat.'",
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';

}}



function download_interp($database,$att1,$att2,$att3)
{
		$classs=for_inter();
	$classs=(string) substr ($classs,2,strlen($classs)-5);
	
	$V=only_correct_triplet_transi($database,get_all_triplet($database),$classs);
	

    $x=new XMLWriter();
    $x->openMemory();
    $x->startDocument('1.0','UTF-8');
    $x->startElement('Query');
    $x->writeAttribute('Scene',"is");
    $objects=explode(",",$att1);
    $actions=explode(",",$att2);
    $actors=explode(",", $att3);

     foreach($objects as $obj)
    {
        $x->startElement('object');
        $x->writeAttribute('name',$obj);
        $x->endElement();

    }

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action);
        $x->endElement(); 
    } 

    foreach ($actors as $act) {

        $x->startElement('actor');
        $x->writeAttribute('name',$act);
        $x->endElement(); 
    }


     $x->startElement('SuperClass');
    $x->writeAttribute('name',$classs);
    $x->endElement(); 
   if(empty($V)){
    $x->startElement('description');	
   	$x->writeAttribute('Well',"this is"." ".$classs);
$x->endElement(); }
else 
{ 
	$x->startElement('description');	
   	$x->writeAttribute('Well',create_sentences($V[0]));
$x->endElement();

}


     $x->endElement(); 

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\resultat.xml", $xml);


}


function get_all_triplett($database)

{


	$actors=$_POST['actts'];
	$actions=$_POST['act3'];
	$objects=$_POST['obj3'];
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
function get_all_triplettt($database,$gg)

{


	$actors=$gg;
	$actions=$_POST['act3'];
	$objects=$_POST['obj3'];
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

function interpp($database)
{	
	$classs=for_inter();

	$classs=(string) substr ($classs,2,strlen($classs)-5);


$V=only_correct_triplet_transi($database,get_all_triplett($database),$classs);
if(!empty($V))

{	$c=create_sentences($V[0]);
	$maxx=strlen($c);

	   $_SESSION['message2']=$c;
	   $_SESSION['message2']=str_replace("\n","",$_SESSION['message2']);
	   echo '<script>
    setTimeout(function() {
        swal({
            title: "Wow!",
            text:"'.$_SESSION['message2'].'",
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';
echo create_sentences($V[0]);

}




else 
{	

	$actors=$_POST['actts'];
	$new_traitement=$classs;
	$se9sini=$new_traitement."_".$actors;
	$chaine1="python3 interp.py ".(string)$se9sini;

	
	$resultat1=shell_exec($chaine1);
	
	$gg=$resultat1;
	$_POST['actts']=$gg;
	$a=get_all_triplettt($database,$gg);
	#print_r($a);
	$V=joke($database,$a,$classs);

	if(!empty($V))

{	$c=create_sentences2($V[0],$actors);
	$maxx=strlen($c);

	   $_SESSION['message2']=$c;
	   $_SESSION['message2']=str_replace("\n","",$_SESSION['message2']);
	   echo '<script>
    setTimeout(function() {
        swal({
            title: "Wow!",
            text:"'.$_SESSION['message2'].'",
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';
echo create_sentences2($V[0],$actors);
}

	else 
	{

	#$V=joke($database,get_all_triplettt($database,$gg),$classs);




	
	$resultat="This is a ".$classs." and there's here ".$_POST['obj3'];

	
		
echo '<script>
    setTimeout(function() {
        swal({
            title: "Wow!",
            text:"'.$resultat.'",
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';
}}}




function download_interpp($database,$att1,$att2,$att3)
{
	$classs=for_inter();
	$classs=(string) substr ($classs,2,strlen($classs)-5);
	echo $classs;
	
	$V=only_correct_triplet_transi($database,get_all_triplett($database),$classs);

	

    $x=new XMLWriter();
    $x->openMemory();
    $x->startDocument('1.0','UTF-8');
    $x->startElement('Query');
    $x->writeAttribute('Scene',"is");
    $objects=explode(",",$att1);
    $actions=explode(",",$att2);
    $actors=explode(",", $att3);

     foreach($objects as $obj)
    {
        $x->startElement('object');
        $x->writeAttribute('name',$obj);
        $x->endElement();

    }

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action);
        $x->endElement(); 
    } 

    foreach ($actors as $act) {

        $x->startElement('actor');
        $x->writeAttribute('name',$act);
        $x->endElement(); 
    }


     $x->startElement('SuperClass');
    $x->writeAttribute('name',$classs);
    $x->endElement(); 
   if(empty($V)){
    $x->startElement('description');	
   	$x->writeAttribute('Well',"this is"." ".$classs);
$x->endElement(); }
else 
{ 
	$x->startElement('description');	
   	$x->writeAttribute('Well',create_sentences($V[0]));
$x->endElement();

}


     $x->endElement(); 

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\resultatt.xml", $xml);


}

?>