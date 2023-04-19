<?php
    session_start();
    include('../../db.php');


    $keyawal = $_POST["keyawal"];

    $database->getReference('distribusi/'. $keyawal)->remove();


?>