<?php

function download_classi($database,$att1,$att2,$att3)
{

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

    $objects=$att1;
    $actions=$att2;
    $chaine="python tests.py";  
    $objects=str_replace(" ","$",$objects);
    $actions=str_replace(" ","$",$actions);
    $chaine=$chaine.' '.$objects.'_'.$actions;

    $resultat= shell_exec($chaine);
    
    $x->startElement('SuperClass');
    $x->writeAttribute('name',substr($resultat, 2, strlen($resultat)-5));
    $x->endElement(); 

     $x->endElement(); 

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\Query.xml", $xml);



}









function ALL_data($database){

$dbsuperclass = $database->prepare("SELECT * FROM superclass");
$dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls");
$dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls");
$dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls");

// fetch all artists
$dbsuperclass->execute();
$superclasss=$dbsuperclass->fetchAll(PDO::FETCH_ASSOC);




foreach ($superclasss as $superclass) {

	$x=new XMLWriter();
$x->openMemory();
$x->startDocument('1.0','UTF-8');


    $x->startElement('superclass');
    $x->writeAttribute('name',$superclass['Classname']);

    // fetch all albums of this artist        
    $dbobject->execute(array(':cls' => $superclass['Classname']));
    $objects = $dbobject->fetchAll(PDO::FETCH_ASSOC);

    foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
        $x->endElement(); // album
    } 


    $dbactor->execute(array(':cls' => $superclass['Classname']));
    $actors = $dbactor->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actors as $actor) {

        $x->startElement('actors');
        $x->writeAttribute('name',$actor['Actorname']);
        $x->endElement(); // album
    } 



     $dbaction->execute(array(':cls' => $superclass['Classname']));
    $actions = $dbaction->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action['Actionname']);
        $x->endElement(); // album
    } 






    $x->endElement(); // artist

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$superclass['Classname'].".xml", $xml);

}

 

}


function precisier($database){


    $ordre=$_POST['a'];
    if ($ordre ==="ASC")
    {
    $dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls ORDER BY poid  ASC LIMIT :num");} 
    else 
         {
    $dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls ORDER BY poid  DESC LIMIT :num");} 


     $ordre1=$_POST['b'];
     if($ordre1==="ASC")
     {
         $dbaction =  $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls ORDER BY poid ASC LIMIT :num");

     }
     else 
     {
         $dbaction =  $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls ORDER BY poid DESC LIMIT :num");
     }

      $ordre2=$_POST['c'];
     if($ordre2==="ASC")
     {
        $dbactor =  $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls ORDER BY poid ASC LIMIT :num");

     }
     else 
     {

        $dbactor =  $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls ORDER BY poid DESC LIMIT :num");

     }


    
    
    $a=(int)$_POST['nbr_object'];
    $b=(int)$_POST['nbr_action'];
    $c=(int)$_POST['nbr_actor'];
    $dbobject->bindParam(':num', $a, PDO::PARAM_INT);
    $dbobject->bindParam(':cls', $_POST['Superclass'], PDO::PARAM_STR);
    $dbaction->bindParam(':num', $b, PDO::PARAM_INT);
    $dbaction->bindParam(':cls', $_POST['Superclass'], PDO::PARAM_STR);
    $dbactor->bindParam(':num', $c, PDO::PARAM_INT);
    $dbactor->bindParam(':cls', $_POST['Superclass'], PDO::PARAM_STR);
    $dbobject->execute();
    $dbaction->execute();
    $dbactor->execute();
    $x=new XMLWriter();







$x->openMemory();
$x->startDocument('1.0','UTF-8');
$x->startElement('superclass');
$x->writeAttribute('name',$_POST['Superclass']);
$objects = $dbobject->fetchAll(PDO::FETCH_ASSOC);
foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
        $x->writeAttribute('poid',$object['poid']);

        $x->endElement();
    } 
  $actions = $dbaction->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action['Actionname']);
        $x->writeAttribute('poid',$action['Poid']);
        $x->endElement(); 
    } 

    $actors = $dbactor->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actors as $actor) {

        $x->startElement('actors');
        $x->writeAttribute('name',$actor['Actorname']);
         $x->writeAttribute('poid',$actor['Poid']);

        $x->endElement();
    } 

 $x->endElement(); 

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$_POST['Superclass'].".xml", $xml);

} 



function downobjects($database){
$objs=$_POST['dwobject'];
$requette1 =  $database->prepare("SELECT * FROM object_in_superclass WHERE Objectname=:obj");
$requette1->execute(array(':obj'=>$objs)); 
if( $requette1->rowCount() < 0)
{

echo '<script>
    setTimeout(function() {
        swal({
            title: "this object doesnt exist!!",
            showConfirmButton: false,
            type: "error"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';

}
else 
{ 
while($row=$requette1->fetch(PDO::FETCH_ASSOC))
                                { 
                                  $dbobject2 =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls");
                                  $dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls");
                                  $dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls");

                                    $x=new XMLWriter();
$x->openMemory();
$x->startDocument('1.0','UTF-8');

                                      $x->startElement('superclass');
                                     $x->writeAttribute('name',$row['Classname']);

                                 $dbobject2->execute(array(':cls' => $row['Classname']));
    $objects = $dbobject2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
        $x->endElement(); // album
    } 
    $dbactor->execute(array(':cls' => $row['Classname']));
    $actors = $dbactor->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actors as $actor) {

        $x->startElement('actors');
        $x->writeAttribute('name',$actor['Actorname']);
        $x->endElement(); // album
    } 



     $dbaction->execute(array(':cls' => $row['Classname']));
    $actions = $dbaction->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action['Actionname']);
        $x->endElement(); // album
    } 






    $x->endElement(); // artist

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$row['Classname'].".xml", $xml);



                                }

echo '<script>
    setTimeout(function() {
        swal({
            title: "Download succeed!!",
            showConfirmButton: false,
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';


}





}

function downact($database,$strr,$elem,$objs){
$req="SELECT * FROM xxx WHERE lll=:obj";
$req=str_replace("xxx",$strr,$req);
$req=str_replace("lll",$elem,$req);
$requette1 =  $database->prepare($req);
$requette1->execute(array(':obj'=>$objs)); 
if( $requette1->rowCount() == 0)
{

echo '<script>
    setTimeout(function() {
        swal({
            title: "this object doesnt exist!!",
            showConfirmButton: false,
            type: "error"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';

}
else 
{ 
while($row=$requette1->fetch(PDO::FETCH_ASSOC))
                                { 
                                  $dbobject2 =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls");
                                  $dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls");
                                  $dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls");

                                    $x=new XMLWriter();
$x->openMemory();
$x->startDocument('1.0','UTF-8');

                                      $x->startElement('superclass');
                                     $x->writeAttribute('name',$row['Classname']);

                                 $dbobject2->execute(array(':cls' => $row['Classname']));
    $objects = $dbobject2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
        $x->endElement(); // album
    } 
    $dbactor->execute(array(':cls' => $row['Classname']));
    $actors = $dbactor->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actors as $actor) {

        $x->startElement('actors');
        $x->writeAttribute('name',$actor['Actorname']);
        $x->endElement(); // album
    } 



     $dbaction->execute(array(':cls' => $row['Classname']));
    $actions = $dbaction->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action['Actionname']);
        $x->endElement(); // album
    } 






    $x->endElement(); // artist

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$row['Classname'].".xml", $xml);



                                }

echo '<script>
    setTimeout(function() {
        swal({
            title: "Download succeed!!",
            showConfirmButton: false,
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';


}





}

function superclassdownload($database)
{
    $superclass=$_POST['Superclass'];
    $dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls");
    $dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls");
    $dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls");

    $x=new XMLWriter();
$x->openMemory();
$x->startDocument('1.0','UTF-8');


    $x->startElement('superclass');
    $x->writeAttribute('name',$superclass);

    // fetch all albums of this artist        
    $dbobject->execute(array(':cls' => $superclass));
    $objects = $dbobject->fetchAll(PDO::FETCH_ASSOC);

    foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
        $x->endElement(); // album
    } 


    $dbactor->execute(array(':cls' => $superclass));
    $actors = $dbactor->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actors as $actor) {

        $x->startElement('actors');
        $x->writeAttribute('name',$actor['Actorname']);
        $x->endElement(); // album
    } 



     $dbaction->execute(array(':cls' => $superclass));
    $actions = $dbaction->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action['Actionname']);
        $x->endElement(); // album
    } 






    $x->endElement(); // artist

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$superclass.".xml", $xml);

echo '<script>
    setTimeout(function() {
        swal({
            title: "Download succeed!!",
            showConfirmButton: false,
            type: "success"
        }, function() {
            window.location.href = "home.php";
        });
    }, 1000);
</script>';










}



function precpoid($database){

$Superclass=$_POST['Superclasss'];
$query=$database->prepare('SELECT * from superclass where Classname=:cls');
$query->execute(array(':cls'=>$Superclass));
$gg1 =$query->fetchAll(PDO::FETCH_ASSOC);
foreach ($gg1 as $objects) {
    $gg=(int)$objects['Nbr_Object'];
    $gg1=(int)$objects['Nbr_Action'];
    $gg2=(int)$objects['Nbr_Actor'];
    $p=(int)$_POST['dwprec'];
$poid=($gg*$p)/100;
$poid= (int)$poid;
$reste=$gg-$poid;
$requette="SELECT * FROM object_in_superclass WHERE Classname=:cls ORDER BY poid DESC LIMIT :num";
$query=$database->prepare($requette);
$query->bindParam(':num', $poid, PDO::PARAM_INT);
$query->bindParam(':cls',$Superclass, PDO::PARAM_STR);
$query->execute();

$x=new XMLWriter();
$x->openMemory();
$x->startDocument('1.0','UTF-8');
$x->startElement('superclass');
$x->writeAttribute('name',$_POST['Superclass']);
$objects = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
      

        $x->endElement();
    }

$requette="SELECT * FROM object  ORDER BY RAND()  LIMIT :num";
$query=$database->prepare($requette);
$query->bindParam(':num', $reste, PDO::PARAM_INT);
$query->execute();

$objects = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['NameObj']);
    

        $x->endElement();
    }




    $p=(int)$_POST['dwprec'];
$poid=($gg1*$p)/100;
$poid= (int)$poid;

$requette="SELECT * FROM Action_in_superclass WHERE Classname=:cls ORDER BY poid DESC LIMIT :num";
$query=$database->prepare($requette);
$query->bindParam(':num', $poid, PDO::PARAM_INT);
$query->bindParam(':cls',$Superclass, PDO::PARAM_STR);
$query->execute();

$actions = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action['Actionname']);
        $x->writeAttribute('poid',$action['Poid']);
        $x->endElement(); 
    } 

$reste=$gg1-$poid;
$requette="SELECT * FROM action  ORDER BY RAND()  LIMIT :num";
$query=$database->prepare($requette);
$query->bindParam(':num', $reste, PDO::PARAM_INT);
$query->execute();

$objects = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($objects as $object) {

        $x->startElement('action');
        $x->writeAttribute('name',$object['Actionname']);
    

        $x->endElement();
    }


 $p=(int)$_POST['dwprec'];
$poid=($gg2*$p)/100;
$poid= (int)$poid;

$requette="SELECT * FROM Actor_in_superclass WHERE Classname=:cls ORDER BY poid DESC LIMIT :num";
$query=$database->prepare($requette);
$query->bindParam(':num', $poid, PDO::PARAM_INT);
$query->bindParam(':cls',$Superclass, PDO::PARAM_STR);
$query->execute();

$actions = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($actions as $action) {

        $x->startElement('action');
        $x->writeAttribute('name',$action['Actorname']);
        $x->writeAttribute('poid',$action['Poid']);
        $x->endElement(); 
    } 

$reste=$gg2-$poid;
$requette="SELECT * FROM actor  ORDER BY RAND()  LIMIT :num";
$query=$database->prepare($requette);
$query->bindParam(':num', $reste, PDO::PARAM_INT);
$query->execute();

$objects = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($objects as $object) {

        $x->startElement('Actor');
        $x->writeAttribute('name',$object['Actorname']);
    

        $x->endElement();
    }




$x->endElement(); 

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$Superclass.".xml", $xml);
    
    } 


}




function download_scene($database,$nbr,$nbr2,$nbr3){

$precision=(int)$_POST['nbrprec'];
$nmbr_taken=(int)(($nbr*$precision)/100);
$dbsuperclass = $database->prepare("SELECT * FROM superclass");
$dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls ORDER BY poid DESC LIMIT :nbr");
$reste=$nbr-$nmbr_taken;
$resteobj=$database->prepare("SELECT * FROM object  ORDER BY RAND()  LIMIT :num");
$dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls AND  Poid > 70");
$dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls AND Poid > 70");

$dbsuperclass->execute();
$superclasss=$dbsuperclass->fetchAll(PDO::FETCH_ASSOC);


foreach ($superclasss as $superclass) {

    $x=new XMLWriter();
$x->openMemory();
$x->startDocument('1.0','UTF-8');
    

    $x->startElement('superclass');
    $x->writeAttribute('name',$superclass['Classname']);
    $dbobject->bindParam(':nbr', $nmbr_taken, PDO::PARAM_INT);
    $dbobject->bindParam(':cls',$superclass['Classname'], PDO::PARAM_STR);
    $dbobject->execute();
    $objects = $dbobject->fetchAll(PDO::FETCH_ASSOC);

    foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
        $x->endElement(); 
    } 

    $resteobj->bindParam(':num',$reste,PDO::PARAM_INT);
    $resteobj->execute();

    $objects = $resteobj->fetchAll(PDO::FETCH_ASSOC);
foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['NameObj']);
    

        $x->endElement();
    }

$dbaction->execute(array(':cls'=>$superclass['Classname'])); 
$actions_s=$dbaction->fetchAll(PDO::FETCH_ASSOC);
if ($dbaction->rowCount()!=0){
    $items=array();
    foreach ($actions_s as $as) { 
    $items[] = $as['Actionname']; 
} 
$i=0; 
while ($i<$nbr2)
{
$ran=rand (0, sizeof($items)-1);


$x->startElement('action');
        $x->writeAttribute('name',$items[$ran]);
        $x->endElement(); 
   array_splice($items, $ran, 1);

$i++;}
}



$dbactor->execute(array(':cls'=>$superclass['Classname'])); 
$actor_s=$dbactor->fetchAll(PDO::FETCH_ASSOC);
if ($dbactor->rowCount()!=0){
    $items=array();
    foreach ($actor_s as $ass) { 
    $items[] = $ass['Actorname']; 
} 
$i=0; 
while ($i<$nbr3 && !empty($items))
{
$ran=rand (0, sizeof($items)-1);


$x->startElement('actor');
        $x->writeAttribute('name',$items[$ran]);
        $x->endElement(); 
           array_splice($items, $ran, 1);



$i++;}
}


















 $x->endElement(); 

$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$superclass['Classname'].".xml", $xml);

}


}

function generer_scence($database){

$superclasse=$_POST['gsceneclass'];
$nmbrobjc=(int)$_POST['nbrobjectscene'];
$nmbraction=(int)$_POST['nbractionscene'];
$nmbractor=(int)$_POST['nbractionscene'];
$nbrscene=(int)$_POST['nbrscene'];
$precisions=floatval($_POST['precisionscene']);


$dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls and poid >50");
$resteobjs=$database->prepare("SELECT * FROM object  ORDER BY RAND()  LIMIT :num");
$dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls AND  Poid > 70");
$resteactions=$database->prepare("SELECT * FROM action  ORDER BY RAND()  LIMIT :num");

$dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls AND Poid > 70");

$resteactors=$database->prepare("SELECT * FROM actor  ORDER BY RAND()  LIMIT :num");
$nombreobject=(int)($nmbrobjc*$precisions);
$resteobj=$nmbrobjc-$nombreobject;
$nombreaction=(int)($nmbraction*$precisions);
$resteaction=$nmbraction-$nombreaction;
$nombreactor=(int)($nmbractor*$precisions);
$resteactor=$nmbractor-$nombreactor;
    $dbaction->bindParam(':cls',$superclasse, PDO::PARAM_STR);
    $dbaction->execute();
    $actions = $dbaction->fetchAll(PDO::FETCH_ASSOC);


    $dbobject->bindParam(':cls',$superclasse, PDO::PARAM_STR);
    $dbobject->execute();
    $objects = $dbobject->fetchAll(PDO::FETCH_ASSOC);

    $dbactor->bindParam(':cls',$superclasse, PDO::PARAM_STR);
    $dbactor->execute();
    $actorss = $dbactor->fetchAll(PDO::FETCH_ASSOC);

    
  

    if ($dbobject->rowCount()!=0){
        //objects
    $items=array();
    foreach ($objects as $as) { 
    $items[] = $as['Objectname'];}
        //actions
        $acitems=array();
        foreach ($actions as $as) { 
        $acitems[] = $as['Actionname'];}


        $actoritems=array();
        foreach ($actorss as $as) { 
        $actoritems[] = $as['Actorname'];}



    for($i=0;$i<$nbrscene;$i++)
    {    $x=new XMLWriter();
    $x->openMemory();
    $x->startDocument('1.0','UTF-8');
    

    $x->startElement('superclass');
    $x->writeAttribute('name',$superclasse);

        //generation des objects
                     $j=0; 
                     while ($j<$nombreobject && !empty($items))
                     {
                        $ran=rand (0, sizeof($items)-1);
                                $x->startElement('object');
                                        $x->writeAttribute('name',$items[$ran]);

                                                $x->endElement(); 
                                                        array_splice($items, $ran, 1);

                        $j++;

                     }
                    foreach ($objects as $as) { 
                    $items[] = $as['Objectname'];}

        $resteobjs->bindParam(':num',$resteobj,PDO::PARAM_INT);
        $resteobjs->execute();

        $objectss = $resteobjs->fetchAll(PDO::FETCH_ASSOC);
        foreach ($objectss as $object) {

            $x->startElement('object');
            $x->writeAttribute('name',$object['NameObj']);
    

            $x->endElement();
                                     }  

        //generation d'actions 

    if ($dbobject->rowCount()!=0){
       

         $b=0;
         while($b<$nombreaction && !empty($acitems))

                    {
                         $ran=rand (0, sizeof($acitems)-1);
                                $x->startElement('action');
                                        $x->writeAttribute('name',$acitems[$ran]);

                                                $x->endElement(); 
                                                        array_splice($acitems, $ran, 1);











                    $b++;}       
                    foreach ($actions as $as) { 
                    $acitems[] = $as['Actionname'];}
                     $resteactions->bindParam(':num',$resteaction,PDO::PARAM_INT);
                    $resteactions->execute();
                    $actionss = $resteactions->fetchAll(PDO::FETCH_ASSOC);
        foreach ($actionss as $acs) {

            $x->startElement('Action');
            $x->writeAttribute('name',$acs['Actionname']);
    

            $x->endElement();
                                     }  



    }   


    //generer actors  


     if ($dbactor->rowCount()!=0){

        $c=0; 
         while($c<$nombreactor && !empty($actoritems))
         {


            $ran=rand (0, sizeof($actoritems)-1);
                                $x->startElement('actor');
                                        $x->writeAttribute('name',$actoritems[$ran]);

                                                $x->endElement(); 
                                                        array_splice($actoritems, $ran, 1);







        $c++; }


             foreach ($actorss as $as) { 
                    $actoritems[] = $as['Actorname'];}
                     $resteactors->bindParam(':num',$resteactor,PDO::PARAM_INT);
                    $resteactors->execute();
                    $act = $resteactors->fetchAll(PDO::FETCH_ASSOC);
        foreach ($act as $acss) {

            $x->startElement('actor');
            $x->writeAttribute('name',$acss['Actorname']);
    

            $x->endElement();
                                     }  















    }


















                     $x->endElement(); 

                    $x->endDocument();
                    $xml = $x->outputMemory();
                    $save = "/ALL_XML/";
                    file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$i.".xml", $xml);





                }


}


}
function gg($database)

{
	
	foreach ($_POST['multiclass'] as $names)
{
$superclasse=$names;

$nmbrobjc=(int)$_POST['multiobject'];
$nmbraction=(int)$_POST['multiaction'];
$nmbractor=(int)$_POST['multiactor'];
$nbrscene=(int)$_POST['multinbr'];
$precisions=floatval($_POST['multipreci']);


$dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls and poid >50");
$resteobjs=$database->prepare("SELECT * FROM object  ORDER BY RAND()  LIMIT :num");
$dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls AND  Poid > 70");
$resteactions=$database->prepare("SELECT * FROM action  ORDER BY RAND()  LIMIT :num");

$dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls AND Poid > 70");

$resteactors=$database->prepare("SELECT * FROM actor  ORDER BY RAND()  LIMIT :num");
$nombreobject=(int)($nmbrobjc*$precisions);
$resteobj=$nmbrobjc-$nombreobject;
$nombreaction=(int)($nmbraction*$precisions);
$resteaction=$nmbraction-$nombreaction;
$nombreactor=(int)($nmbractor*$precisions);
$resteactor=$nmbractor-$nombreactor;
    $dbaction->bindParam(':cls',$superclasse, PDO::PARAM_STR);
    $dbaction->execute();
    $actions = $dbaction->fetchAll(PDO::FETCH_ASSOC);


    $dbobject->bindParam(':cls',$superclasse, PDO::PARAM_STR);
    $dbobject->execute();
    $objects = $dbobject->fetchAll(PDO::FETCH_ASSOC);

    $dbactor->bindParam(':cls',$superclasse, PDO::PARAM_STR);
    $dbactor->execute();
    $actorss = $dbactor->fetchAll(PDO::FETCH_ASSOC);

    
  

    if ($dbobject->rowCount()!=0){
        //objects
    $items=array();
    foreach ($objects as $as) { 
    $items[] = $as['Objectname'];}
        //actions
        $acitems=array();
        foreach ($actions as $as) { 
        $acitems[] = $as['Actionname'];}


        $actoritems=array();
        foreach ($actorss as $as) { 
        $actoritems[] = $as['Actorname'];}



    for($i=0;$i<$nbrscene;$i++)
    {    $x=new XMLWriter();
    $x->openMemory();
    $x->startDocument('1.0','UTF-8');
    

    $x->startElement('superclass');
    $x->writeAttribute('name',$superclasse);

        //generation des objects
                     $j=0; 
                     while ($j<$nombreobject && !empty($items))
                     {
                        $ran=rand (0, sizeof($items)-1);
                                $x->startElement('object');
                                        $x->writeAttribute('name',$items[$ran]);

                                                $x->endElement(); 
                                                        array_splice($items, $ran, 1);

                        $j++;

                     }
                    foreach ($objects as $as) { 
                    $items[] = $as['Objectname'];}

        $resteobjs->bindParam(':num',$resteobj,PDO::PARAM_INT);
        $resteobjs->execute();

        $objectss = $resteobjs->fetchAll(PDO::FETCH_ASSOC);
        foreach ($objectss as $object) {

            $x->startElement('object');
            $x->writeAttribute('name',$object['NameObj']);
    

            $x->endElement();
                                     }  

        //generation d'actions 

    if ($dbobject->rowCount()!=0){
       

         $b=0;
         while($b<$nombreaction && !empty($acitems))

                    {
                         $ran=rand (0, sizeof($acitems)-1);
                                $x->startElement('action');
                                        $x->writeAttribute('name',$acitems[$ran]);

                                                $x->endElement(); 
                                                        array_splice($acitems, $ran, 1);











                    $b++;}       
                    foreach ($actions as $as) { 
                    $acitems[] = $as['Actionname'];}
                     $resteactions->bindParam(':num',$resteaction,PDO::PARAM_INT);
                    $resteactions->execute();
                    $actionss = $resteactions->fetchAll(PDO::FETCH_ASSOC);
        foreach ($actionss as $acs) {

            $x->startElement('Action');
            $x->writeAttribute('name',$acs['Actionname']);
    

            $x->endElement();
                                     }  



    }   


    //generer actors  


     if ($dbactor->rowCount()!=0){

        $c=0; 
         while($c<$nombreactor && !empty($actoritems))
         {


            $ran=rand (0, sizeof($actoritems)-1);
                                $x->startElement('actor');
                                        $x->writeAttribute('name',$actoritems[$ran]);

                                                $x->endElement(); 
                                                        array_splice($actoritems, $ran, 1);







        $c++; }


             foreach ($actorss as $as) { 
                    $actoritems[] = $as['Actorname'];}
                     $resteactors->bindParam(':num',$resteactor,PDO::PARAM_INT);
                    $resteactors->execute();
                    $act = $resteactors->fetchAll(PDO::FETCH_ASSOC);
        foreach ($act as $acss) {

            $x->startElement('actor');
            $x->writeAttribute('name',$acss['Actorname']);
    

            $x->endElement();
                                     }  















    }


















                     $x->endElement(); 

                    $x->endDocument();
                    $xml = $x->outputMemory();
                    $save = "/ALL_XML/";
                    file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$names.'_'.$i.".xml", $xml);





                }


}
}
	
}


?>