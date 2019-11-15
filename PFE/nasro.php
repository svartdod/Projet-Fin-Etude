function download_scene($database,$nbr1,$nbr2,$nbr3){

$precision=(int)$_POST['nbrprec'];
$nmbr_taken=(int)(($nbr*$precision)/100);
$dbsuperclass = $database->prepare("SELECT * FROM superclass");
$dbobject =  $database->prepare("SELECT * FROM object_in_superclass WHERE Classname=:cls LIMIT :nbr");
$reste=$nbr-$nmbr_taken;
$resteobj=$database->prepare("SELECT * FROM object  ORDER BY RAND()  LIMIT :num");
$dbaction =   $database->prepare("SELECT * FROM action_in_superclass WHERE Classname=:cls");
$dbactor =   $database->prepare("SELECT * FROM actor_in_superclass WHERE Classname=:cls");

$dbsuperclass->execute();
$superclasss=$dbsuperclass->fetchAll(PDO::FETCH_ASSOC);


foreach ($superclasss as $superclass) {

    $x=new XMLWriter();
$x->openMemory();
$x->startDocument('1.0','UTF-8');
    echo "xD";

    $x->startElement('superclass');
    $x->writeAttribute('name',$superclasss['Classname']);
    $dbobject->bindParam(':nbr', $nmbr_taken, PDO::PARAM_INT);
    $dbobject->bindParam(':cls',$superclasss, PDO::PARAM_STR);
    $dbobject->execute();
    foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['Objectname']);
        $x->endElement(); 
    } 

    $resteobj->bindParam(':num',$reste,PDO::PARAM_INT);
    $resteobj->execute();

    $objects = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($objects as $object) {

        $x->startElement('object');
        $x->writeAttribute('name',$object['NameObj']);
    

        $x->endElement();
    }



 $x->endElement(); 
echo "GG";  
$x->endDocument();
$xml = $x->outputMemory();
$save = "/ALL_XML/";
file_put_contents("C:\\wamp64\\www\\PFE\\ALL_XML\\".$superclasss.".xml", $xml);

}


}