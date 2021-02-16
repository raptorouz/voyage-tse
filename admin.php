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

		<!-- jQuery -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<!-- boostrap js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script>
	<script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
	<link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<!-- Fonts  -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="style/main.css">

	<!-- FontAwesome (icons) -->
	<script src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" data-auto-replace-svg="nest"></script>





	<!-- Custom JS -->
	<script type="text/javascript" src="js/search.js"></script>

</head>
<body>


	<div class="sidenav">
        <img class="img-responsive logo" src="res/img/tse_logo_small.png" alt="">
        <a href="index.php"><i class="fas fa-home"></i> Accueil</a>
        <a href="admin.php"><i class="fas fa-plane"></i>  Voyages  </a>
        <a href="map.php"><i class="fas fa-map-marked-alt"></i> Carte du monde</a>
    </div>

	<div class="main">


		<!--	https://mdbootstrap.com/docs/jquery/forms/search/ -->
		<div class="input-group md-form form-sm form-1 pl-0">
			<div class="input-group-prepend">
				<span class="input-group-text purple lighten-3" id="basic-text1"> <i class="fas fa-search text-white" aria-hidden="true"></i></span>
			</div>
			<input class="form-control my-0 py-1"  id="myInput" type="text" placeholder="Rechercher un étudiant, un pays, une ville, une date, ..." aria-label="Search">
		</div>

		<div>
			<table id="thisTable" class="table table-striped table-dark" >
				<thead>
					<tr>

						<th scope="col">Réf. voyage</th>
						<th scope="col">Prénom</th>
						<th scope="col">Nom</th>
						<th scope="col">Mail</th>
						<th scope="col">Promo</th>
						<th scope="col">Pays</th>
						<th scope="col">Ville</th>
						<th scope="col">Date de début</th>
						<th scope="col">Date de fin</th>

					</tr>
				</thead>
				 <tbody id="myTable">
						<?php
						session_start();
						require_once('db_utils.php');

						$result = get_voyages_with_students();

						// Get infos of result, i.e. table name, columns, ...
						//$finfo = mysqli_info_about_result($result);

						// Content of table
						$row = 1;
					    foreach ($result as $value) {
					        echo '<tr data-rowid="'.$value['id'].'">';


							// Content table
							//echo '<th scope="row">' . $row . '</th>';
							echo '<td>'. $value[ 'id' ].'</td>';
							echo '<td>'. $value[ 'prenom' ].'</td>';
							echo '<td>'. $value[ 'nom' ].'</td>';
							echo '<td>'. $value[ 'email' ].'</td>';
							echo '<td>'. $value[ 'promo' ].'</td>';
							echo '<td data-info="pays">'. $value[ 'pays' ].'</td>';
							echo '<td data-info="ville">'. $value[ 'ville' ].'</td>';
							echo '<td data-info="date_debut">'. $value[ 'date_debut' ].'</td>';
							echo '<td data-info="date_fin">'. $value[ 'date_fin' ].'</td>';
							/*
					        foreach ($finfo as $val) {
					            echo '<td>'. $value[ ($val->name) ].'</td>';
					        }
							*/


							echo '
							<td>
								<button id="myBtn" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#exampleModal" data-ville="'.$value['ville'].'" data-pays="'.$value['pays'].'" data-debut="'.$value['date_debut'].'" data-fin="'.$value['date_fin'].'" data-voyage="'.$value['id'].'" data-nom="'.$value['nom'].'" data-prenom="'.$value['prenom'].'" title="Edit"><i class="fa fa-edit"></i></button>
							</td>
							<td>
								<button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" onclick="deleteRow(this,'.$value[ 'id' ].')"  title="Delete"><i class="fa fa-trash"></i></button>
							</td>';
					        echo "</tr>";
							$row++;
					    }

						 ?>



					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="editForm">
						<div class="form-group">
							<label for="pays" class="col-form-label" style="text-align:left;">Pays</label>
							<select class="form-control selectpicker countrypicker" data-live-search="true" id="pays" name="pays" ></select>
							<script>
							$('.countrypicker').countrypicker();
							</script>
						</div>
						<div class="form-group">
							<label for="ville" class="col-form-label" style="text-align:left;">Ville</label>
							<input class="form-control" type="text" id="ville" placeholder="Saint-Etienne" name="ville"required>
						</div>

						<div class="form-group">
							<label for="date-debut" class="col-form-label" style="text-align:left;">Date de début</label>
							<input class="form-control" type="date" id="date-debut" name="date_debut" required>
						</div>
						<div class="form-group">
							<label for="date-fin" class="col-form-label" style="text-align:left;">Date de fin</label>
							<input class="form-control" type="date" id="date-fin" name="date_fin" required>
						</div>
						<div class="form-group" style="display:none;" >
							<label for="voyage" class="col-form-label" style="text-align:left;">Voyage ID	</label>
							<input class="form-control" type="text" id="voyage" name="voyage" required>
						</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
	        <button type="button" class="btn btn-primary" onclick="sauvegarder()" data-dismiss="modal">Sauvegarder</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script>


	function sauvegarder(e){
		var ville = $('#ville').val();
		var pays = $('#pays').val();
		var date_debut = $('#date-debut').val();
		var date_fin = $('#date-fin').val();
		var voyage = $('#voyage').val();
		var ajaxRequest= $.post("modify.php",{
				'pays': pays,
				'ville':ville,
				'date_debut':date_debut,
				'date_fin':date_fin,
				'id':voyage
			}, function(data) {

				// updating info in tab
				var row = document.querySelector('[data-rowid="'+voyage+'"]');
				row.querySelector("[data-info=pays]").textContent= pays;
				row.querySelector("[data-info=ville]").textContent = ville;
				row.querySelector("[data-info=date_debut]").textContent =  date_debut;
				row.querySelector("[data-info=date_fin]").textContent = date_fin ;

	});
}
	function deleteRow(e,idRow){
		var ajaxRequest= $.post("delete.php",{
        'id': idRow
      }, function(data) {
	e.parentElement.parentElement.remove();
});
	}


	</script>

	<script>
	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var ville = button.data('ville') // Extract info from data-* attributes
		var pays = button.data('pays') // Extract info from data-* attributes
		var debut = button.data('debut') // Extract info from data-* attributes
		var fin = button.data('fin') // Extract info from data-* attributes
		var voyage= button.data('voyage') // Extract info from data-* attributes
		var prenom = button.data('prenom')
		var nom = button.data('nom')
	  var modal = $(this)
	  modal.find('.modal-title').text('Edition du voyage de ' + prenom + " " + nom)
	  modal.find('#date-fin').val(fin)
	  modal.find('#date-debut').val(debut)
	  modal.find('#ville').val(ville)
		modal.find('#pays').val(pays)
		modal.find('#pays').attr("data-default",pays)
		$('.selectpicker').selectpicker('render');
		modal.find('#voyage').val(voyage)
	})
	</script>
</body>
</html>
