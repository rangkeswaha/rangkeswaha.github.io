<?php
    include('../../db.php');
                                
    // // sudah mau jalan //
    $ref_hpembelian = 'Hpembelian_stok';
    $fetchdatahpembelian = $database->getReference($ref_hpembelian)->getSnapshot()->getValue();

    // // Filter Data
    // $fetchdatadetailpenjualan = array_filter($fetchdatadetailpenjualanraw, function($detail) {
    //     return $detail['status_penjualan'] === 'Pembayaran Diterima';
    // });

    // Add the key ID to the array
    foreach ($fetchdatahpembelian as $key => $item) {
        $item['key'] = $key;
        $fetchdatahpembelian[$key] = $item;
    }
    
    foreach ($fetchdatahpembelian as $key => $item) {
        $ref_tableinventory = 'inventory/' . $item['id_Barang'];
        $fetchdatainventory = $database->getReference($ref_tableinventory)->getValue();

        // echo $item['key'] . '<br>';
    
        // Check if the retrieved data is not empty
        if (!empty($fetchdatainventory)) {
            // Update the array with the retrieved data
            $fetchdatahpembelian[$key]['nama_barang'] = $fetchdatainventory['nama_barang'];
            $fetchdatahpembelian[$key]['foto_barang'] = $fetchdatainventory['foto_barang'];
        }
        // echo 'Nama : ' . $fetchdatadetailpenjualan[$key]['nama_pembeli'] .  'id : ' . $fetchdatadetailpenjualan[$key]['key'] . '<br>';
    }

    foreach ($fetchdatahpembelian as $key => $item) {
        $ref_tablepembelian = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
        $fetchdatapembelian = $database->getReference($ref_tablepembelian)->getValue();

        $fetchdatahpembelian[$key]['jumlah_barang'] = $fetchdatapembelian['jumlah_barang'] . " kg";
        $fetchdatahpembelian[$key]['tanggal_pembelian'] = $fetchdatapembelian['tanggal_pembelian'];
        $fetchdatahpembelian[$key]['lama_pembelian'] = $fetchdatapembelian['lama_pembelian'] . " Hari";
    
    }

    $arr = [];
    $co = 0;
    if($fetchdatahpembelian > 0){
        $i = 0;
        foreach($fetchdatahpembelian as $key => $row){
            $arr[$co] = array(
                'key' => $key,
                'nama_barang' => $row['nama_barang'],
                'foto_barang' => $row['foto_barang'],
                'stok_dibeli' => $row['jumlah_barang'],
                'tanggal_pembelian' => $row['tanggal_pembelian'],
                'lama_pembelian' => $row['lama_pembelian'],
            );
            $co++;
        }
    }

    echo json_encode($arr);

?>