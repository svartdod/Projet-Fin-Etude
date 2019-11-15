<?php 
function check($database)
{
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$query="SELECT * FROM etudiant where nom=:nom and prenom=:prenom";
$requette=$database->prepare($query);
$requette->execute(array(':nom'=>$nom,':prenom'=>$prenom)); 
if( $requette->rowCount() > 0)
{

	//hna diri traitement ta3 inscription 
}

else 
	{ 

		echo " this etudiants doesn't existe and he cant sign in "; 
	}




}
?>