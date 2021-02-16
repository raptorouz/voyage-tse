<?php

	/*
  A METTRE DANS UN AUTRE FICHIER

	Connection à la base de donnée suivant un login et mot de passe transmis en parametre

	@return : true si connection reussie
	*/
	function connect_db($adress = '127.0.0.1',$user = "root", $password = "root", $database = 'db_project', $port = NULL){
		$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

		$adress = $url["host"];
		$user = $url["user"];
		$password = $url["pass"];
		$database = substr($url["path"], 1);
	
		$mysqli_connection = mysqli_connect($adress, $user, $password, $database, $port);
		$mysqli_set_charset($mysqli_connection, "utf8");
		
		if ($mysqli_connection->connect_error) {
			die('Connect Error (' . $mysqli_connection->connect_errno . ') '
					. $mysqli_connection->connect_error);
		}

		return $mysqli_connection;
	}

	function mysqli_info_about_result($result) {
	    $finfo = $result->fetch_fields();
	    return $finfo;
	}

	/*
	* get_all_from_table : realise une requete SQL pour recupérer tous les elements
	* d'une table donnée en paramètre
	*
	* @params string nom de la table
	* @return mysqli_result
	*/
	function get_all_from_table($table = ""){
		// Connection DB
		$con = connect_db();

		// Exécution de la requête
		$result = mysqli_query($con, "SELECT * FROM $table");

		// Vérification du résultat
		// Ceci montre la requête envoyée à MySQL ainsi que l'erreur. Utile pour déboguer.
		if (!$result) {
			$message  = 'Requête invalide  ' . "\n";
		die($message);
		}

		return $result;
	}

	/*
	* get_voyages_with_students : realise une requete SQL pour recupérer tous les elements
	* d'une table donnée en paramètre
	*
	* @params string nom de la table
	* @return mysqli_result
	*/
	function get_voyages_with_students(){
		// Connection DB
		$con = connect_db();

		// Exécution de la requête
		/*
		$result = mysqli_query($con,
		"SELECT
			v.id, v.id_etudiant, v.pays, v.ville, v.date_debut, v.date_fin,
			e.prenom, e.nom, e.email
		FROM `voyage` AS v INNER JOIN `etudiant` AS e ON v.id_etudiant = e.id"); */

		$result = mysqli_query($con,
		"SELECT
			v.id, v.id_etudiant, v.pays, v.ville, v.date_debut, v.date_fin,
			e.prenom, e.nom, e.email, e.promo
		FROM `voyage` AS v INNER JOIN `etudiant` AS e ON v.id_etudiant = e.id");

		// Vérification du résultat
		// Ceci montre la requête envoyée à MySQL ainsi que l'erreur. Utile pour déboguer.
		if (!$result) {
			$message  = 'Requête invalide : ' . mysqli_error() . "\n";
		die($message);
		}

		return $result;
	}

	/*
	*  TODO : uniquement email
	*/
	function get_etudiant_id($email, $prenom ='default', $nom = 'default', $promo = 'default'){
		// Connection DB
		$con = connect_db();

		// Exécution de la requête
		$result = mysqli_query($con, "SELECT id FROM etudiant WHERE email LIKE '$email'");

		// Vérification du résultat
		// Ceci montre la requête envoyée à MySQL ainsi que l'erreur.
		if (!$result) {
			$message  = 'Requête invalide :  \n';
		die($message);
		}
		$row = mysqli_fetch_array($result);
		return $row[0];
	}

	/*
	* get_last_row : retourne la derniere ligne d'un resultat mysqli donné en paramètre
	*
	* @params result mysqli
	* @return array
	*/
	function get_last_row($res) {
		if(!is_null($res)){
		  $row = mysqli_fetch_row($res);
		  return $row;
		} else {
				return null;
			}
	}

	/*
	*get_last_row_of_table permet d'obtenir la derniere ligne (dernier id) d'une table
  *
  *@params nom de la table (string)
	*/
	function get_last_row_of_table($table = "") {
			$res = get_all_from_table($table);
			if(!is_null($res)){
				$array = $res->fetch_all();
				return $array[sizeof($array) - 1];
			}else{
				return null;
			}
	}

	/*
	* insert : realise une requete SQL pour inserer un etudiant
	*
	*/
	function insert_etudiant($prenom = 'default', $nom = 'default', $promo = 'default', $email = 'defaut@telecom-st-etienne.fr'){
		// Connection DB
		$con = connect_db();

		// Query
		$query = "INSERT INTO	etudiant(prenom, nom, promo, email)
		VALUES ('$prenom', '$nom', '$promo', '$email')";

				mysqli_query($con,$query) or die("Error");
				return get_etudiant_id($email);

	}

	/*
	* insert : realise une requete SQL pour inserer un voyage
	*
	*/
	function insert_voyage($id_etudiant, $pays = 'default', $ville = 'default', $date_debut,  $date_fin){
		// Connection DB
		$con = connect_db();

		// Query
		$query = "INSERT INTO `voyage`(`id_etudiant`, `pays`, `ville`, `date_debut`, `date_fin`)
		VALUES ('$id_etudiant','$pays','$ville','$date_debut','$date_fin')";

		if (check_etudiant_id($id_etudiant)) {
			if(compare_date($date_debut, $date_fin) && check_date_format($date_debut) && check_date_format($date_fin)){
				mysqli_query($con,$query) or die("Error : request abort");
				return TRUE;
			} else{
				header('HTTP/1.0 500 Internal Server Error');
				die("Starting date is greater than ending date or date doesn't respect format : YYYY-mm-dd");
			}
		} else{
			header('HTTP/1.0 500 Internal Server Error');
			die("Error : etudiant with id ". $id_etudiant ." doesn't exist in DB");
		}

		//return mysqli_query($con,$query) or die("Error");
	}

	/*
	* checkDateFormat : retourne vrai si la date en parametre correspond au
	* format : 'YYYY-mm-dd' (string)
	*
	@param
	@return TRUE si le format correspond, sinon FALSE
	*/
	function check_date_format($date){
		$dt = DateTime::createFromFormat("Y-m-d", $date);
		return $dt !== false && !array_sum($dt::getLastErrors());
	}

	/*
	*
	*/
	function compare_date($date_debut, $date_fin){
		$dateTime_debut = new DateTime($date_debut);
		$dateTime_fin = new DateTime($date_fin);
		return ($dateTime_fin> $dateTime_debut) ? TRUE : FALSE ;
	}

	/*
	*check_etudiant vérifie si un etudiant est présent au moins un fois dans la
	* table etudiant par son email
  *
	*@params email d'un etudiant (string)
	*@return vrai si l'étudiant est présent au moins un fois
	*/
	function check_etudiant($email){
		// Connection DB
		$con = connect_db();

		// Query
		$result = mysqli_query($con, "SELECT COUNT(*) FROM etudiant WHERE email LIKE '$email'");
		$datarow = $result->fetch_array();

		return ($datarow[0] > 0) ? get_etudiant_id($email) : FALSE;

	}

	/*
	*check_etudiant_id vérifie si un etudiant est présent au moins un fois dans la
	* table etudiant par son id
	*
	*@params id  d'un etudiant (int)
	*@return vrai si l'étudiant est présent au moins un fois (boolean)
	*/
	function check_etudiant_id($id){
		// Connection DB
		$con = connect_db();

		// Query
		$result = mysqli_query($con, "SELECT COUNT(*) FROM etudiant WHERE id LIKE '$id'");
		$datarow = $result->fetch_array();

		return ($datarow[0] > 0) ? TRUE : FALSE;

	}

	/*
	*check_voyage_id vérifie si un votage est présent au moins un fois dans la
	* table voyage par son id
	*
	*@params id  voyage (int)
	*@return vrai si le voyage est présent au moins un fois (boolean)
	*/
	function check_voyage_id($id){
		// Connection DB
		$con = connect_db();

		// Query
		$result = mysqli_query($con, "SELECT COUNT(*) FROM voyage WHERE id LIKE '$id'");
		$datarow = $result->fetch_array();

		return ($datarow[0] > 0) ? TRUE : FALSE;

	}

	/*
	* delete_last_id_of_table : delete le dernier element ajouté en prenant le dernier id d'une
	* table passée en paramètre
	*
	* @params nom de la table (string)
	* @return bool
	*/
	function delete_last_id_of_table($table){
		// Connection DB
		$con = connect_db();

		// Dernier id
		$row = get_last_row_of_table($table);
		$last_id = $row[0];

		// Requete
		$query = "DELETE FROM $table WHERE id=$last_id";

		return mysqli_query($con,$query);
	}

	/*
	* delete_voyage_with_id : delete le dernier element ajouté en prenant le dernier id de

	* de voyage
	*
	* @params nom de la table (string)
	* @return bool
	*/
	function delete_voyage_with_id($id_voyage){
		// Connection DB
		$con = connect_db();

		// Requete
		$query = "DELETE FROM voyage WHERE id=$id_voyage";

		return check_voyage_id($id_voyage) ?  mysqli_query($con,$query) : die("Voyage ID doesnt exist");
	}

	function voyages2array(){
		$res =  get_voyages_with_students();
		$array2return = [];

		foreach ($res as $value) {
		    $temp = array(
		        $value[ 'id' ],
		        $value[ 'prenom' ],
		        $value[ 'nom' ],
		        $value[ 'email' ],
		        $value[ 'promo' ],
		        $value[ 'pays' ],
		        $value[ 'ville' ],
		        $value[ 'date_debut' ],
		        $value[ 'date_fin' ]
		    );
		    array_push($array2return, $temp);
		}

		return $array2return;
	}
?>
