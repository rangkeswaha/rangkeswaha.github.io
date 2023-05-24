<?php
    include('../../db.php');

    $keynota = $_POST["keynota"];


    // // sudah mau jalan //
    $ref_table = 'Nota_penjualan/' . $keynota;
    $fetchdata = $database->getReference($ref_table)->getValue();

    // // Add the key ID to the array
    // foreach ($fetchdata as $key => $item) {
    //     $item['key'] = $key;
    //     $fetchdata[$key] = $item;
    // }
    // echo ($fetchdata['nama_pembeli']);



    $arr = [];
    $co = 0;

    $arr[$co] = array(
        'nama_pembeli' => $fetchdata['nama_pembeli'],
    );
    $co++;
    if($fetchdata > 0){
        $i = 0;
        foreach($fetchdata['list_barang'] as $key => $row){
            $arr[$co] = array(
                'nama_barang' => $row['nama_barang'],
                'harga_barang' => $row['harga_barang'],
                'stok_dijual' => $row['stok_dijual'],
            );
            $co++;
        }
    }

    echo json_encode($arr);


?>