<?php
?>
<!DOCTYPE HTML>
<!--
Identity by HTML5 UP
html5up.net | @ajlkn
Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Student Management</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="//unpkg.com/jquery@3.4.1/dist/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script>
	<script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="style/main.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
	<link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />

</head>

<body>
	<?php
	session_start();
	require_once('db_utils.php');


	/**
	 * Creates a token usable in a form
	 * @return string
	 */
	function getToken()
	{
		$token = sha1(mt_rand());
		if (!isset($_SESSION['tokens'])) {
			$_SESSION['tokens'] = array($token => 1);
		} else {
			$_SESSION['tokens'][$token] = 1;
		}
		return $token;
	}

	/**
	 * Check if a token is valid. Removes it from the valid tokens list
	 * @param string $token The token
	 * @return bool
	 */
	function isTokenValid($token)
	{
		if (!empty($_SESSION['tokens'][$token])) {
			unset($_SESSION['tokens'][$token]);
			return true;
		}
		return false;
	}

	// Check if a form has been sent
	$postedToken = filter_input(INPUT_POST, 'token');
	if (!empty($postedToken)) {
		if (isTokenValid($postedToken)) {

			$id_etudiant = check_etudiant($_POST["mail"]);
			if ($id_etudiant == FALSE) {
				$id_etudiant = insert_etudiant($_POST["prenom"], $_POST["nom"], $_POST["promo"], $_POST["mail"]);
			}

			if (insert_voyage($id_etudiant, $_POST["pays"], $_POST["ville"], $_POST["date_debut"], $_POST["date_fin"])) {
				header("location: admin.php");
			} else {
				echo "erreur";
			}
		} else {
			header("location: admin.php");
		}
	}
	$token = getToken();
	?>
	<section id="cover" class="min-vh-100">
		<div id="cover-caption">
			<div class="container">
				<div class="row text-white">
					<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
						<img class="tse" src="res/img/tse_logo_small.png" alt="logo" style="height: 80px;">
						<h2 class="display-4 py-2">Enregistrer un Voyage</h2>
						<div class="px-2">
							<form action="index.php" class="justify-content-center" method="post">

								<input type="hidden" name="token" value="<?php echo $token; ?>" />

								<div class="form-group">
									<label for="prenom" class="col-form-label" style="text-align:left;">Prenom</label>
									<input type="text" class="form-control" placeholder="Jane" id="prenom" name="prenom" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>

								</div>
								<div class="form-group">
									<label for="nom" class="col-form-label" style="text-align:left;">Nom</label>
									<input type="text" class="form-control" placeholder="Doe" id="nom" name="nom" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
								<div class="form-group">
									<label for="example-email-input" class="col-form-label" style="text-align:left;">Email</label>
									<input class="form-control" type="email" id="example-email-input" placeholder="prenom.nom@telecom-st-etienne.fr" name="mail" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
								<!--
								<div class="form-group">
								<label for="example-tel-input" class="col-form-label" style="text-align:left;">Téléphone</label>
								<input class="form-control" type="tel" id="example-tel-input" placeholder="06 XX XX XX XX">
							</div>
						-->
								<div class="form-group">
									<label for="example-promo-input" class="col-form-label" style="text-align:left;">Promo</label>
									<select class=form-control id="example-promo-input" name="promo">
										<option value=FISE3>FISE3</option>
										<option value=FISE2>FISE2</option>
										<option value=FISE1>FISE1</option>
									</select>
								</div>
								<div class="form-group">
									<label for="pays" class="col-form-label" style="text-align:left;">Pays</label>
									<select class="form-control selectpicker countrypicker" data-default="FR" data-live-search="true" id="pays" name="pays"></select>
									<script>
										$('.countrypicker').countrypicker();
									</script>
								</div>
								<div class="form-group">
									<label for="ville" class="col-form-label" style="text-align:left;">Ville</label>
									<input class="form-control" type="text" id="ville" placeholder="Saint-Etienne" name="ville" required>
								</div>

								<div class="form-group">
									<label for="date-debut" class="col-form-label" style="text-align:left;">Date de début</label>
									<input class="form-control" type="date" id="date-debut" name="date_debut" required>
								</div>
								<div class="form-group">
									<label for="date-fin" class="col-form-label" style="text-align:left;">Date de fin</label>
									<input class="form-control" type="date" id="date-fin" name="date_fin" required>
								</div>
								<button type="submit" class="btn btn-primary btn-lg">Valider</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</body>

</html>