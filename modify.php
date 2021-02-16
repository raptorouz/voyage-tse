<?php
require_once('db_utils.php');
	if(isset($_POST['id'])){
		modify_voyage_with_id($_POST['id'],$_POST['pays'],$_POST['ville'],$_POST['date_debut'],$_POST['date_fin']);
	}
?>
