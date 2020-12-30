<<?php
require_once('db_utils.php');

function object_to_array($data)
{
    if(is_array($data) || is_object($data))
    {
        $result = array();

        foreach($data as $key => $value) {
            $result[$key] = $this->object_to_array($value);
        }

        return $result;
    }

    return $data;
}


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

echo json_encode( $array2return );

 ?>
