<?php

session_start();
include('../../db.php');

    $query = $database->getReference('Hpenjualan')->orderByKey()->limitToLast(1);
    $result = $query->getValue();
    
    echo json_encode($result);
?>