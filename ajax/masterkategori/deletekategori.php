<?php
    include('../../db.php');
     
    $formeditkategori = $_POST["formeditkategori"];
    $kategoriawal = $_POST["kategoriawal"];
    $keyawal = $_POST["keyawal"];

    $database->getReference('mkategori/'. $keyawal)->remove();

?>
