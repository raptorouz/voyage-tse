<?php

require 'db_utils.php';

$mysqli = connect_db('127.0.0.1');
echo '<p>Connection OK '. $mysqli->host_info.'</p>';
echo '<p>Server '.$mysqli->server_info.'</p>';
echo '<p>Initial charset: '.$mysqli->character_set_name().'</p>';

function mysqli_result($res, $row, $field=0) {
    $res->data_seek($row);
    $datarow = $res->fetch_array();
    return $datarow[$field];
}

function mysqli_info_about_result($result) {
    $finfo = $result->fetch_fields();
    return $finfo;
}

/*
*Test get from a table and display result
*/
function test_get_all_from($table = ""){
  $result = get_all_from_table($table);

  // Get infos of result, i.e. table name, columns, ...
  $finfo = mysqli_info_about_result($result);

  // Table name
  //echo "<h1>" . $finfo[0]->table ."</h1>"."\n";

  // Header
  echo "<table border='1'><tr>";
  foreach ($finfo as $val) {
      echo '<th>'.($val->name).'</th>';
  }
  echo "</tr>";

  // Content of table
  foreach ($result as $value) {
      echo "<tr>";
      foreach ($finfo as $val) {
          echo '<td>'. $value[ ($val->name) ].'</td>';
      }
      echo "</tr>";
  }

  // Libération des résultats
  $result->free();
}

/*
*Test get from a table and display result
*/
function test_get_all_voyages_with_students(){
  $result = get_voyages_with_students();

  // Get infos of result, i.e. table name, columns, ...
  $finfo = mysqli_info_about_result($result);

  // Table name
  //echo "<h2>" . $finfo[0]->table ."</h2>";

  // Header
  echo "<table border='1'><tr>";
  foreach ($finfo as $val) {
      echo '<th>'.($val->name).'</th>';
  }
  echo "</tr>";

  // Content of table
  foreach ($result as $value) {
      echo "<tr>";
      foreach ($finfo as $val) {
          echo '<td>'. $value[ ($val->name) ].'</td>';
      }
      echo "</tr>";
  }

  // Libération des résultats
  $result->free();
}

// INSERT VOYAGES
//insert_voyage(80, 'France', 'Marseille', '2021-06-22',  '2021-08-20');
//delete_voyage_with_id(11);

// GETTERS
test_get_all_from("etudiant");
test_get_all_from("voyage");
test_get_all_voyages_with_students();

// INSERT
// insert_etudiant('Vincent', 'Ortolano', 'FISE3', 'c@tse.fr');

//delete_last_id_of_table("voyage");
if(check_voyage_id(7)){
  echo '<p> True </p>';
}
// DELETE


$noms1 = get_etudiant_id('eric.yammine@telecom-st-etienne.fr');
echo "<table border='1'>
<tr> <th>Id - Eric</th>  </tr>";
foreach ($noms1 as $nom) {
    echo "<tr>";
    foreach ($nom as $n) {
        echo "<td>" . $n . "</td>";
    }
    echo "</tr>";
}
// Libération des résultats
$noms1->free();

$noms2 = get_etudiant_id('cedric.gormond@telecom-st-etienne.fr');
echo "<table border='1'>
<tr> <th>Id - Cedric</th>  </tr>";
foreach ($noms2 as $nom) {
    echo "<tr>";
    foreach ($nom as $n) {
        echo "<td>" . $n . "</td>";
    }
    echo "</tr>";
}
// Libération des résultats
$noms2->free();

?>
