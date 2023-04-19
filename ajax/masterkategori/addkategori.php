<?php

    session_start();
    include('../../db.php');

    $formkategori = $_POST["formkategori"];
    // $formkategori = "SegAR";

    $postData = [
        'kategori' => $formkategori,
    ];

    $ref_table = 'mkategori';
    $fetchdata = $database->getReference($ref_table)->getValue();

    $arr = [];
    if($fetchdata > 0){
        $i = 0;
        foreach($fetchdata as $key => $row){
            array_push($arr, $row);
        }
    }


    $checkvalue = 0;
    foreach($arr as $key => $row){
        if (strtolower($row['kategori']) == strtolower($formkategori)){
            $checkvalue = 1;
            break;
        }
        // echo ($row['kategori']);
    }

    if($checkvalue == 0){
        $ref_table = "mkategori";
        $postRef_result = $database->getReference($ref_table)->push($postData);
        echo ("Kategori Berhasil Disimpan");
    }else{
        echo ("Kategori Sudah Ada");
    }

    // $ref_table = "mkategori";
    // $postRef_result = $database->getReference($ref_table)->push($postData);


    // var ref = new Firebase(URL);
    // var record = ref.push(userInfo);
    // console.log("User was assigned ID: " + record.name());

    // if($postRef_result){
    //     $session['status'] = "Barang Telah Ditambahkan";
    //     header('Location: ../../index.php');
    // }
    // else{
    //     $session['status'] = "Barang Gagal Ditambahkan";
    //     header('Location: ../../index.php');
    // }

?>