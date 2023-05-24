<?php
    include('../../db.php');
                                    
    // $ref_table = 'distribusi';
    // $fetchdata = $database->getReference($ref_table)->getValue();

    // $arr = [];
    // $co = 0;
    // if($fetchdata > 0){
    //     $i = 0;
    //     foreach($fetchdata as $key => $row){
    //         $arr[$co] = array(
    //             'key' => $key,
    //             'alamat_pembeli' => $row['alamat_pembeli'],
    //             'deskripsi_pembeli' => $row['deskripsi_pembeli'],
    //             'foto_pembeli' => $row['foto_pembeli'],
    //             'nama_pembeli' => $row['nama_pembeli'],
    //             'savedetail_address' => $row['savedetail_address'],
    //             'savelatitude' => $row['savelatitude'],
    //             'savelongitude' => $row['savelongitude'],
    //         );
    //         $co++;
    //     }
    // }

    // echo json_encode($arr);

    // $ref_table = 'Nota_penjualan';
    // $fetchdata = $database->getReference($ref_table)->getSnapshot()->getValue();

    // // Convert the JSON data to an array
    // // $goods = json_decode($fetchdata, true);

    // // // Print the inventory data
    // // foreach ($fetchdata as $item) {
    // //     echo 'Item: ' . $item['key'] . '<br>';
    // // }

    // // Add the key ID to the array
    // foreach ($fetchdata as $key => $item) {
    //     $item['key'] = $key;
    //     $fetchdata[$key] = $item;
    // }

    // // Print the nota penjualan data key IDs
    // foreach ($fetchdata as $item) {
    //     echo 'Key ID: ' . $item['key'] . " " . $item['nama_pembeli'] . " " . $item['list_barang'][0]['nama_barang'] .  '<br>';
    // }

    // $ref_table2 = 'Nota_penjualan';
    // $fetchdata2 = $database->getReference($ref_table)->getSnapshot()->getValue();

    // foreach ($goods as $key => $value) {
    //     $goods[$key]['date'] = $dates[$key]['date'];
    //     $goods[$key]['time'] = $dates[$key]['time'];
    // }



    // // // Print the nota penjualan data key IDs
    // // foreach ($fetchdatadetailpenjualan as $item) {
    // //     echo 'Key ID: ' . $item['key'] . " " . $item['id_Distribusi'] .  '<br>';
    // // }

    // // coba ambil data by key //
    // // $ref_tabledistribusi = 'distribusi/' . "-NUXqJ7Zo9WpgsGho-8-";
    // // $fetchdatadistribusi = $database->getReference($ref_tabledistribusi)->getValue();

    // // // Add the key ID to the array
    // // foreach ($fetchdatadistribusi as $key => $item) {
    // //     $item['key'] = $key;
    // //     $fetchdatadistribusi[$key] = $item;
    // // }

    // // // Print the nota penjualan data key IDs
    // // foreach ($fetchdatadistribusi as $item) {
    // //     echo 'Key ID: ' . $item['key'] . " " . $item['nama_pembeli'] .  '<br>';
    // // }

    // // // Print the nota penjualan data
    // // echo 'Nama : ' . $fetchdatadistribusi['nama_pembeli'] . ', Deskripsi: ' . $fetchdatadistribusi['deskripsi_pembeli'];



    // // ambil data yang dibutuhkan di database lain
    // foreach ($fetchdatadetailpenjualan as $key => $item) {
    //     $ref_tabledistribusi = 'distribusi/' . $item['key'];
    //     $fetchdatadistribusi = $database->getReference($ref_tabledistribusi)->getValue();

    //     foreach ($fetchdatadistribusi as $key2 => $item2) {
    //         $fetchdatadetailpenjualan[$key]['nama_pembeli'] = $fetchdatadistribusi[$key]['nama_pembeli'];
    //     }
    // }

    
    // $ref_tabledetailpenjualan = $database->getReference('Detail_penjualan');

    // // Retrieve the data where the "status" attribute is "married"
    // $fetchdatadetailpenjualan = $ref_tabledetailpenjualan->orderByChild('status_penjualan')->equalTo('Proses Pengiriman')->getValue();


    // // sudah mau jalan //
    $ref_tabledetailpenjualan = 'Detail_penjualan';
    $fetchdatadetailpenjualanraw = $database->getReference($ref_tabledetailpenjualan)->getSnapshot()->getValue();

    $fetchdatadetailpenjualan = array_filter($fetchdatadetailpenjualanraw, function($detail) {
        return $detail['status_penjualan'] === 'Proses Pengiriman' || $detail['status_penjualan'] === 'Menunggu Pembayaran';
    });

    // Add the key ID to the array
    foreach ($fetchdatadetailpenjualan as $key => $item) {
        $item['key'] = $key;
        $fetchdatadetailpenjualan[$key] = $item;
    }
    
    foreach ($fetchdatadetailpenjualan as $key => $item) {
        $ref_tabledistribusi = 'distribusi/' . $item['id_Distribusi'];
        $fetchdatadistribusi = $database->getReference($ref_tabledistribusi)->getValue();

        // echo $item['key'] . '<br>';
    
        // Check if the retrieved data is not empty
        if (!empty($fetchdatadistribusi)) {
            // Update the array with the retrieved data
            $fetchdatadetailpenjualan[$key]['nama_pembeli'] = $fetchdatadistribusi['nama_pembeli'];
            $fetchdatadetailpenjualan[$key]['foto_pembeli'] = $fetchdatadistribusi['foto_pembeli'];
            $fetchdatadetailpenjualan[$key]['savedetail_address'] = $fetchdatadistribusi['savedetail_address'];
            $fetchdatadetailpenjualan[$key]['savelatitude'] = $fetchdatadistribusi['savelatitude'];
            $fetchdatadetailpenjualan[$key]['savelongitude'] = $fetchdatadistribusi['savelongitude'];
        }
        // echo 'Nama : ' . $fetchdatadetailpenjualan[$key]['nama_pembeli'] .  'id : ' . $fetchdatadetailpenjualan[$key]['key'] . '<br>';
    }

    foreach ($fetchdatadetailpenjualan as $key => $item) {
        $ref_tablenota = 'Nota_penjualan/' . $item['id_Nota_penjualan'];
        $fetchdatanota = $database->getReference($ref_tablenota)->getValue();

        // echo $fetchdatanota['key'] . '<br>';

        $ref_tablepengingat = 'Pengingat/' . $fetchdatanota['id_Pengingat'];
        $fetchdatapengingat = $database->getReference($ref_tablepengingat)->getValue();

        $dateTime = new DateTime($fetchdatapengingat['tanggal_pengiriman']);
        $formattedDate = $dateTime->format('Y-m-d h:i:s A');

        // echo $formattedDate;

        $fetchdatadetailpenjualan[$key]['tanggal_pembayaran'] = $fetchdatapengingat['tanggal_pembayaran'];
        $fetchdatadetailpenjualan[$key]['tanggal_pengiriman'] = $formattedDate;
    
        // // Check if the retrieved data is not empty
        // if (!empty($fetchdatanota)) {
        //     // Update the array with the retrieved data
        //     $fetchdatadetailpenjualan[$key]['nama_pembeli'] = $fetchdatanota['nama_pembeli'];
        // }
        // echo 'tanggal_pembayaran : ' . $fetchdatadetailpenjualan[$key]['tanggal_pembayaran'] . "  " .  'tanggal_pengiriman : ' . $fetchdatadetailpenjualan[$key]['tanggal_pengiriman'] . '<br>';
    }

    $arr = [];
    $co = 0;
    if($fetchdatadetailpenjualan > 0){
        $i = 0;
        foreach($fetchdatadetailpenjualan as $key => $row){
            $arr[$co] = array(
                'key' => $key,
                'nama_pembeli' => $row['nama_pembeli'],
                'jumlah_barang' => $row['jumlah_barang'],
                'total_harga' => $row['total_harga'],
                'tanggal_pengiriman' => $row['tanggal_pengiriman'],
                'tanggal_pembayaran' => $row['tanggal_pembayaran'],
                'status_penjualan' => $row['status_penjualan'],
                'foto_pembeli' => $row['foto_pembeli'],
                'savedetail_address' => $row['savedetail_address'],
                'savelatitude' => $row['savelatitude'],
                'savelongitude' => $row['savelongitude'],
                'id_Nota_penjualan' => $row['id_Nota_penjualan'],
            );
            $co++;
        }
    }

    echo json_encode($arr);

    // $arr = [];
    // echo gettype($fetchdatadetailpenjualan);
    // echo gettype($arr);
    

    // foreach ($fetchdatadetailpenjualan as $key => $item) {
    //     $ref_tabledistribusi = 'Nota_penjualan/' . $item['key'];
    //     $fetchdatadistribusi = $database->getReference($ref_tabledistribusi)->getValue();
    
    //     $fetchdatadistribusi['key'] = $item['key'];
    
    //     foreach ($fetchdatadetailpenjualan as $key3 => $value) {
    //         if($fetchdatadetailpenjualan[$key3]['key'] == $fetchdatadistribusi['key']){
    //             $fetchdatadetailpenjualan[$key3]['nama_pembeli'] = $fetchdatadistribusi['nama_pembeli'];
    //         }
    //     }
    // }
    

    //  // Print the nota penjualan data key IDs
    // foreach ($fetchdatadetailpenjualan as $item) {
    //     echo 'Key ID: ' . $item['key'] . "      " . $item['nama_pembeli'] .  '<br>';
    // }

?>