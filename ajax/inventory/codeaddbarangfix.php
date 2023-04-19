<?php
    session_start();
    include('../../db.php');

    // echo 'diluar first';

    if(isset($_POST['savebarangbutton'])){

        // echo 'didalem first';
        $namegoods = $_POST["namegoods"];
        $pricegoods = $_POST["pricegoods"];
        $stockgoods = $_POST["stockgoods"];
        $kategoribarang = $_POST["selectKategori"];
        $splitkategori = explode("_", $kategoribarang);
        $kategori = $splitkategori[0];
        $formdeskripsi = htmlentities($_POST['formdeskripsi']);
        $fotobarang = $_FILES["fotobarang"]['name'];

        // echo $fotobarang;

        $random_no = rand(1111,9999);

        $new_image = $random_no.$fotobarang;
    
        $filename = 'uploads/' .$new_image;

        // echo $_POST['formdeskripsi'];

        // echo htmlentities($_POST['formdeskripsi']);;
        

        $properties = [
            'ngoods' => $namegoods,
            'pgoods' => $pricegoods,
            'sgoods' => $stockgoods,
            'kgoods' => $kategori,
            'dgoods' => htmlentities($_POST['formdeskripsi']),
            'fgoods' => $filename,
        ];

        $ref_table = "inventory";
        $postRef_result = $database->getReference($ref_table)->push($properties);

        move_uploaded_file($_FILES['fotobarang']['tmp_name'], "uploads/". $new_image);

        // echo 'didalem last';

        header("Location: ../../inventory/stokbarang.php");

    }

    // echo 'diluar last';

?>