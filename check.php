<?php
require_once('db_utils.php');

foreach($_POST as $query_string_variable => $value) {
   echo "$query_string_variable  = $value <Br />";
}
$id_etudiant = check_etudiant($_POST["mail"]);
if ($id_etudiant == FALSE){
	$id_etudiant = insert_etudiant($_POST["prenom"],$_POST["nom"],$_POST["promo"],$_POST["mail"]);
}

if(insert_voyage($id_etudiant,$_POST["pays"],$_POST["ville"],$_POST["date_debut"],$_POST["date_fin"])){
	header("location: index.php");
}
else{
	echo "erreur lors de l'insertion";
}


?>
