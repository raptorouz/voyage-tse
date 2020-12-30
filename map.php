<!DOCTYPE html>
<html>
<head>
    <title>Carte des voyages</title>
    <!-- Google API -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkHaxPxWc7BgplBDFY93ek58ThJvpWJD4&callback=initMap&libraries=&v=weekly"
    defer>
    </script>

    <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style/map.css">

    <script src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" data-auto-replace-svg="nest"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="js/map.js"></script>
    <script type="text/javascript" src="js/geocoder.js"></script>


</head>
<body>



    <div class="sidenav">
        <img class="img-responsive logo" src="res/img/tse_logo_small.png" alt="">
        <a href="index.php"><i class="fas fa-home"></i> Accueil</a>
        <a href="admin.php"><i class="fas fa-plane"></i>  Voyages  </a>
        <a href="map.php"><i class="fas fa-map-marked-alt"></i> Carte du monde</a>
    </div>

    <!--
    <div id="dom-target" style="display: none;">
        <?php
            // require_once('db_utils.php');

            //$etu = get_voyages_with_students(); // Again, do some operation, get the output.
            //echo htmlspecialchars($etu); /* You have to escape because the result                                   will not be valid HTML otherwise. */
        ?>
    </div> -->
    <script>
        var students = <?php require_once('db_utils.php'); echo json_encode(voyages2array()); ?>; // Don't forget the extra semicolon!
        arrayStudentsToMaps(students);
    </script>
    <div class="main" id="map"></div>

</body>
</html>
