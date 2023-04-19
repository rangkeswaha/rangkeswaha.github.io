<?php
    session_start();

    echo 'diluar first';

    if(isset($_POST['savebarangbutton'])){

        echo 'didalem first';
        // $namegoods = $_POST["namegoods"];
        // $pricegoods = $_POST["pricegoods"];
        // $stockgoods = $_POST["stockgoods"];
        // $kategoribarang = $_POST["kategoribarang"];
        // $formdeskripsi = $_POST["formdeskripsi"];
        // $fotobarang = $_FILES["fotobarang"]['name'];

        // $random_no = rand(1111,9999);

        // $new_image = $random_no.$fotobarang;
    
        // $filename = 'uploads/' .$newimage;
        

        // $properties = [
        //     'ngoods' => $namegoods,
        //     'pgoods' => $pricegoods,
        //     'sgoods' => $stockgoods,
        //     'kgoods' => $kategoribarang,
        //     'dgoods' => $formdeskripsi,
        //     'fgoods' => $filename,
        // ];

        // $ref_table = "inventory";
        // $postRef_result = $database->getReference($ref_table)->push($properties);

        echo 'didalem last';

        header("Location: index.php");

    }

    echo 'diluar last';

?>