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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


	<link rel="preconnect" href="https://fonts.gstatic.com">

	<!-- Fonts  -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="style/main.css">

	<!-- FontAwesome (icons) -->
	<script src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" data-auto-replace-svg="nest"></script>

	<!-- jQuery -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


	<!-- Custom JS -->
	<script type="text/javascript" src="js/search.js"></script>

</head>
<body>

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
	        <form>
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Recipient:</label>
	            <input type="text" class="form-control" id="recipient-name">
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="col-form-label">Message:</label>
	            <textarea class="form-control" id="message-text"></textarea>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Send message</button>
	      </div>
	    </div>
	  </div>
	</div>
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
					        echo "<tr>";


							// Content table
							//echo '<th scope="row">' . $row . '</th>';
							echo '<td>'. $value[ 'id' ].'</td>';
							echo '<td>'. $value[ 'prenom' ].'</td>';
							echo '<td>'. $value[ 'nom' ].'</td>';
							echo '<td>'. $value[ 'email' ].'</td>';
							echo '<td>'. $value[ 'promo' ].'</td>';
							echo '<td>'. $value[ 'pays' ].'</td>';
							echo '<td>'. $value[ 'ville' ].'</td>';
							echo '<td>'. $value[ 'date_debut' ].'</td>';
							echo '<td>'. $value[ 'date_fin' ].'</td>';
							/*
					        foreach ($finfo as $val) {
					            echo '<td>'. $value[ ($val->name) ].'</td>';
					        }
							*/
							echo '
							<td>
								<a href="modify.php?id='.$value[ 'id' ].'"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
							</td>
							<td>
								<button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" onclick="deleteRow(this,'.$value[ 'id' ].')" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
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

	<script>


	function deleteRow(e,idRow){
		var ajaxRequest= $.post("delete.php",{
        'id': idRow
      }, function(data) {
	e.parentElement.parentElement.remove();
});
	}


	</script>
</body>
</html>
