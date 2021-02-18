<?php
require_once('db_utils.php');
if (isset($_POST['id'])) {
	delete_voyage_with_id($_POST['id']);
}
