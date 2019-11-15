<?php 


function Classification(){ 



$objects=$_POST['object15'];
$actions=$_POST['action15'];
$acteurs=$_POST['acteur15'];


$acteurs=explode(',',$acteurs)[0];
$actions=explode(',',$actions)[0];




$new_object=explode(',',$objects);

if(sizeof($new_object)<4){
while(sizeof($new_object)<4)
{
$objects=$objects.",b";
$new_object=explode(',',$objects);


}
}

$objects=explode(',',$objects);
$objects=$objects[0].','.$objects[1].','.$objects[2].','.$objects[3];

if(empty($actions))
{


	$actions="bbbb";
}

$chaine="python3 classifier.py";	
$objects=str_replace(" ","$",$objects);
$actions=str_replace(" ","$",$actions);
$acteurs=str_replace(" ","$",$acteurs);



$chaine=$chaine.' '.$objects.'_'.$actions.'_'.$acteurs;



$resultat= shell_exec($chaine);

echo '<script>
    setTimeout(function() {
        swal({
            title: "Wow!",
            text:'.ucfirst($resultat).',
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
    
</script>';

}


function Classification_interpretation(){ 



$objects=$_POST['object15'];
$actions=$_POST['action15'];
$acteurs=$_POST['acteur15'];
$acteurs=explode(',',$acteurs)[0];
$actions=explode(',',$actions)[0];





$new_object=explode(',',$objects);

if(sizeof($new_object)<4){
while(sizeof($new_object)<4)
{
$objects=$objects.",b";
$new_object=explode(',',$objects);


}
}

$objects=explode(',',$objects);
$objects=$objects[0].','.$objects[1].','.$objects[2].','.$objects[3];
if(empty($actions))
{


	$actions="bbbb";
}

$chaine="python3 classifier.py";	
$objects=str_replace(" ","$",$objects);
$actions=str_replace(" ","$",$actions);
$acteurs=str_replace(" ","$",$acteurs);



$chaine=$chaine.' '.$objects.'_'.$actions.'_'.$acteurs;



$resultat= shell_exec($chaine);
return $resultat;

}

?>