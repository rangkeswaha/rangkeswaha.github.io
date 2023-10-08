<?php
    session_start();
    include('../../db.php');

    // echo 'diluar first';

    if(isset($_POST['savebarangbutton'])){

        // echo 'didalem first';
        $namegoods = $_POST["namegoods"];
        $pricegoodstemp = $_POST["pricegoods"];
        $pricegoods = str_replace(',', '', $pricegoodstemp);
        $stockgoodstemp = $_POST["stockgoods"];
        $stockgoods = str_replace(',', '', $stockgoodstemp);
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
            'nama_barang' => $namegoods,
            'harga_barang' => $pricegoods,
            'stok_barang' => $stockgoods,
            'kategori_barang' => $kategori,
            'deskripsi_barang' => htmlentities($_POST['formdeskripsi']),
            'foto_barang' => $filename,
        ];

        $ref_table = "inventory";
        $postRef_result = $database->getReference($ref_table)->push($properties);

        move_uploaded_file($_FILES['fotobarang']['tmp_name'], "uploads/". $new_image);

        // echo 'didalem last';

        header("Location: ../../inventory/stokbarang.php");

    }

    // echo 'diluar last';

?>