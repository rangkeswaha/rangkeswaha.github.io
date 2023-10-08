<?php

session_start();
include('../../db.php');


    // $humanRef = $database->getReference('Hpenjualan');
    // $query = $humanRef->orderByChild('tanggal_penjualan')->startAt('2023-10')->endAt('2023-10\uf8ff');
    // $data = $query->getValue();

    $keybulan = $_POST["keybulan"];
    $keybarang = $_POST["keybarang"];
    
    // $type = gettype($keybarang);

    // echo json_encode($type);


    // FIFO //
    // get average leadtime
    $Refhpenjualan = $database->getReference('Hpenjualan');
    $snapshot = $Refhpenjualan->getSnapshot();

    $datahpenjualan = $snapshot->getValue();

    $leadtime = 0;
    $matchidcount = 0;

    // bulan -1
    $timestamp = strtotime($keybulan);
    $newTimestamp = strtotime('-1 month', $timestamp);
    $month1 = date('Y-m', $newTimestamp);
    $newDateString = (string) $month1;
    // echo json_encode($newDateString);

    // bulan 0
    $timestampnow = strtotime($keybulan);
    $newTimestampnow = strtotime('0 month', $timestampnow);
    $month1now = date('Y-m', $newTimestampnow);
    $newDateStringnow = (string) $month1now;
    // echo json_encode($newDateString);
    

    $arrpenjualan = [];
    $co = 0;


    foreach ($datahpenjualan as $key => $item) {

        if(date("Ym", strtotime($newDateString)) == date("Ym", strtotime($item['tanggal_penjualan']))){
            $arrpenjualan[$co] = array(
                'id_Detail_penjualan' => $item['id_Detail_penjualan'],
                'tanggal_penjualan' => $item['tanggal_penjualan'],
                'list_id_Barang' => $item['list_id_Barang'],
            );
            $co++;
        }

        // if ($item['id_Barang'] == $keybarang) {
            
        //     $ref_tablepembelian = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
        //     $fetchdatapembelian = $database->getReference($ref_tablepembelian)->getValue();

        //     if (date("Ym", strtotime($newDateString)) == date("Ym", strtotime($fetchdatapembelian['tanggal_pembelian']))) {
        //         // echo json_encode("masuk sini");
        //         $matchidcount++;
        //         $leadtime += $fetchdatapembelian['lama_pembelian'];
        //     }


        // }
    }

    $latestDate = null;
    $latestObject = null;
    $laststock;

    foreach ($arrpenjualan as $object) {
        $date = $object["tanggal_penjualan"];
        if ($latestDate === null || $date > $latestDate) {
            $latestDate = $date;
            $latestObject = $object;
        }
    }

    foreach ($latestObject['list_id_Barang'] as $key => $row) {
        if($row['key'] == $keybarang){
            $laststock = $row['stok_awal'];
            break;
        }
    }

    // echo json_encode($laststock);

    // ambil data pembelian stok bulan sebelumnya
    $Refhpembelian = $database->getReference('Hpembelian_stok');
    $snapshothpembelian = $Refhpembelian->getSnapshot();

    $datahpembelian = $snapshothpembelian->getValue();

    $arrpembelian = [];
    $copembelian = 0;


    foreach ($datahpembelian as $key => $item) {

        if($item['id_Barang'] == $keybarang){
            // $arrpenjualan[$co] = array(
            //     'id_Detail_penjualan' => $item['id_Detail_penjualan'],
            //     'tanggal_penjualan' => $item['tanggal_penjualan'],
            //     'list_id_Barang' => $item['list_id_Barang'],
            // );
            // $co++;
            $ref_tablepembelian = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
            $fetchdatapembelian = $database->getReference($ref_tablepembelian)->getValue();
            
            if(date("Ym", strtotime($newDateString)) == date("Ym", strtotime($fetchdatapembelian['tanggal_pembelian']))){
                $arrpembelian[$copembelian] = array(
                    'jumlah_barang' => $fetchdatapembelian['jumlah_barang'],
                    'tanggal_pembelian' => $fetchdatapembelian['tanggal_pembelian'],
                    'total_harga' => $fetchdatapembelian['total_harga'],
                );
                $copembelian++;
            }
        }
    }

    // sort descending
    usort($arrpembelian, function($a, $b) {
        return strtotime($b['tanggal_pembelian']) - strtotime($a['tanggal_pembelian']);
    });

    $datarealpembelian = [];
    $corealpembelian = 0;

    $templastock = $laststock;
    
    foreach ($arrpembelian as $object) {
        // echo "Name: " . $object['jumlah_barang'] . ", Date: " . $object['tanggal_pembelian'] . "\n";
        if ($templastock - $object['jumlah_barang'] >= 0 || $templastock - $object['jumlah_barang'] == 0 ){
            $datarealpembelian[$corealpembelian] = array(
                'jumlah_barang' => $object['jumlah_barang'],
                'tanggal_pembelian' => $object['tanggal_pembelian'],
                'total_harga' => $object['total_harga'],
            );
            $corealpembelian++;
            $templastock -= $object['jumlah_barang'];
        }
    }

    // data pembelian bulan sekarang
    foreach ($datahpembelian as $key => $item) {

        if($item['id_Barang'] == $keybarang){
            // $arrpenjualan[$co] = array(
            //     'id_Detail_penjualan' => $item['id_Detail_penjualan'],
            //     'tanggal_penjualan' => $item['tanggal_penjualan'],
            //     'list_id_Barang' => $item['list_id_Barang'],
            // );
            // $co++;
            $ref_tablepembelian = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
            $fetchdatapembelian = $database->getReference($ref_tablepembelian)->getValue();
            
            if(date("Ym", strtotime($newDateStringnow)) == date("Ym", strtotime($fetchdatapembelian['tanggal_pembelian']))){
                $datarealpembelian[$corealpembelian] = array(
                    'jumlah_barang' => $fetchdatapembelian['jumlah_barang'],
                    'tanggal_pembelian' => $fetchdatapembelian['tanggal_pembelian'],
                    'total_harga' => $fetchdatapembelian['total_harga'],
                );
                $corealpembelian++;
            }
        }
    }

    // foreach ($datarealpembelian as $object) {
    //     echo "Name: " . $object['jumlah_barang'] . ", Date: " . $object['tanggal_pembelian'] . "\n";
    // }


    // ambil data penjualan stok bulan sekarang

    $arrpenjualanbulanini = [];
    $copenjualanini = 0;

    foreach ($datahpenjualan as $key => $item) {

        if(date("Ym", strtotime($newDateStringnow)) == date("Ym", strtotime($item['tanggal_penjualan']))){
            $arrpenjualanbulanini[$copenjualanini] = array(
                'id_Detail_penjualan' => $item['id_Detail_penjualan'],
                'tanggal_penjualan' => $item['tanggal_penjualan'],
                'list_id_Barang' => $item['list_id_Barang'],
            );
            $copenjualanini++;
        }
    }

    $hargadijual = 0;
    $stokdijualtotal = 0;

    foreach ($arrpenjualanbulanini as $key => $row) {
        foreach ($row['list_id_Barang'] as $key1 => $row1) {
            if($row1['key'] == $keybarang){
                $hargadijual = $row1['harga_barang'];
                $stokdijualtotal += $row1['stok_dijual'];
                break;
            }
        }
    }

    // echo json_encode($laststock);
    // echo "harga: " . $hargadijual . ", stok: " . $stokdijualtotal . "\n";


    // FIFO akhir
    $totalpenjualanini = $hargadijual * $stokdijualtotal;
    $tempstokdijual = $stokdijualtotal;

    $totalpembelianini = 0;

    foreach ($datarealpembelian as $object) {
        // echo "Name: " . $object['jumlah_barang'] . ", Date: " . $object['tanggal_pembelian'] . "\n";
        if ($tempstokdijual - $object['jumlah_barang'] >= 0 || $tempstokdijual - $object['jumlah_barang'] == 0){
            $totalpembelianini += ($object['jumlah_barang'] * ($object['total_harga'] / $object['jumlah_barang']));
            // echo "harga: " . $object['jumlah_barang'] * ($object['total_harga'] / $object['jumlah_barang']) . "\n";
            $tempstokdijual -= $object['jumlah_barang'];
        }
        else if($tempstokdijual != 0){
            $totalpembelianini += ($tempstokdijual * ($object['total_harga'] / $object['jumlah_barang']));
            // echo "harga: " . $tempstokdijual * ($object['total_harga'] / $object['jumlah_barang']) . "\n";
        }
    }

    $FIFO = $totalpenjualanini - $totalpembelianini;
    echo json_encode($FIFO);



    
    
?>