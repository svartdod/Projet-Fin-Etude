<?php 



function traitement(){ 

if(isset($_POST['Claaaaaass']))
{

$objects=$_POST['txtScript'];
$actions=$_POST['actionss'];
}

if (isset($_POST['classs']))
{

$objects=$_POST['obj3'];
$actions=$_POST['act3'];
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
$objects=$objects[0].','.$objects[1].','.$objects[2];


}


$chaine="python3 tests.py";	
$objects=str_replace(" ","$",$objects);
$actions=str_replace(" ","$",$actions);
$chaine=$chaine.' '.$objects.'_'.$actions;

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

function for_inter(){ 

if(isset($_POST['Claaaaaass']) || isset($_POST['downloadd']))
{

$objects=$_POST['txtScript'];
$actions=$_POST['actionss'];
}

if (isset($_POST['classs'])  || isset($_POST['downs']) )
{

$objects=$_POST['obj3'];
$actions=$_POST['act3'];
}


$chaine="python3 tests.py"; 
$objects=str_replace(" ","$",$objects);
$actions=str_replace(" ","$",$actions);
$chaine=$chaine.' '.$objects.'_'.$actions;

$resultat= shell_exec($chaine);

return $resultat;
}

?>



