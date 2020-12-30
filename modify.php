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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
#cover {
    background: #222 center center no-repeat;
    background-size: cover;
    height: 100%;
    text-align: center;
    display: flex;
    align-items: center;
    position: relative;
}

#cover-caption {
    width: 100%;
    position: relative;
    z-index: 1;
}

/* only used for background overlay not needed for centering */
form:before {
    content: '';
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    background-color: rgba(0,0,0,0.3);
    z-index: -1;
    border-radius: 10px;
}

</style>
	</head>
<?php
	# Recuperer données du voyage en cours de modification
	# Afficher dans chaque "case"
	
	?>

<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h2 class="display-4 py-2">Enregistrer un Voyage</h2>
                    <div class="px-2">
                        <form action="" class="justify-content-center">
                            <div class="form-group">
							 <label for="prenom" class="col-form-label" style="text-align:left;">Prenom</label>
                                <input type="text" class="form-control" placeholder="Jane Doe" id="prenom">
                            </div>
                            <div class="form-group">
							 <label for="nom" class="col-form-label" style="text-align:left;">Nom</label>
                                <input type="text" class="form-control" placeholder="jane.doe@example.com" id="nom">
                            </div>
							<div class="form-group">
							 <label for="example-email-input" class="col-form-label" style="text-align:left;">Email</label>
							 <input class="form-control" type="email" id="example-email-input" placeholder= "uneadresse@mail">
							</div>
							<div class="form-group">
							 <label for="example-tel-input" class="col-form-label" style="text-align:left;">Téléphone</label>
							 <input class="form-control" type="tel" id="example-tel-input" placeholder="06 XX XX XX XX">
							</div>
											<div class="form-group">
							 <label for="pays" class="col-form-label" style="text-align:left;">Pays</label>
							 <input class="form-control" type="text" id="pays" placeholder="France">
							</div>
							<div class="form-group">
							 <label for="ville" class="col-form-label" style="text-align:left;">Ville</label>
							 <input class="form-control" type="text" id="ville" placeholder="Saint-Etienne">
							</div>							
							
							<div class="form-group">
							 <label for="date-debut" class="col-form-label" style="text-align:left;">Date de début</label>
							 <input class="form-control" type="date" id="date-debut">
							</div>
							<div class="form-group">
							 <label for="date-fin" class="col-form-label" style="text-align:left;">Date de fin</label>
							 <input class="form-control" type="date" id="date-fin">
							</div>
                            <button type="submit" class="btn btn-primary btn-lg">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>