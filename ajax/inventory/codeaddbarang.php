<?php

// function debug_to_console($data) {
//     $output = $data;
//     if (is_array($output))
//         $output = implode(',', $output);

//     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }

    // function debug_to_console($data) {
    //     $output = $data;
    //     if (is_array($output))
    //         $output = implode(',', $output);

    //     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    // }

    session_start();
    include('../../db.php');

    // debug_to_console('halo');

    $namegoods = $_POST["namegoods"];
    $pricegoods = $_POST["pricegoods"];
    $stockgoods = $_POST["stockgoods"];
    $kategoribarang = $_POST["kategoribarang"];
    $formdeskripsi = $_POST["formdeskripsi"];
    $fotobarang = $_POST["file"];

    // $randomNo = rand(1111,9999);

    // console_log($kategoribarang);

    // $newfoto = $randomNo.$fotobarang;

    // $filename = 'uploads/'.$newfoto;

    $target_dir = "uploads/";
    $target_file = $target_dir . round(microtime(true)) . '.' . basename($_FILES["file"]["name"]);
    $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $postData = [
        'ngoods' => $namegoods,
        'pgoods' => $pricegoods,
        'sgoods' => $stockgoods,
        'kgoods' => $kategoribarang,
        'dgoods' => $formdeskripsi,
        'fgoods' => $target_file,
    ];

    // debug_to_console($filename);

    $ref_table = "inventory";
    $postRef_result = $database->getReference($ref_table)->push($postData);

    // if($postRef_result){
    //     $session['status'] = "Barang Telah Ditambahkan";
    //     header('Location: ../../index.php');
    // }
    // else{
    //     $session['status'] = "Barang Gagal Ditambahkan";
    //     header('Location: ../../index.php');
    // }

?>