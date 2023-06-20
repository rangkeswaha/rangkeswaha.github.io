<?php
    include('../../db.php');


    // // sudah mau jalan //
    $ref_tabledetailpenjualan = 'Detail_penjualan';
    $fetchdatadetailpenjualanraw = $database->getReference($ref_tabledetailpenjualan)->getSnapshot()->getValue();

    $fetchdatadetailpenjualan = array_filter($fetchdatadetailpenjualanraw, function($detail) {
        return $detail['status_penjualan'] === 'Proses Pengiriman';
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


?>