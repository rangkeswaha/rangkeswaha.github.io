<?php

session_start();
include('../../db.php');


    // $humanRef = $database->getReference('Hpenjualan');
    // $query = $humanRef->orderByChild('tanggal_penjualan')->startAt('2023-10')->endAt('2023-10\uf8ff');
    // $data = $query->getValue();

    // $humanRef = $database->getReference('Hpenjualan');
    // $snapshot = $humanRef->getSnapshot();

    // $data = $snapshot->getValue();

    // $filteredData = array_filter($data, function($item) {
    //     return strpos($item['tanggal_penjualan'], '2023-10') === 0;
    // });
    
    // echo json_encode($filteredData);

    // $dateString = '2023-10';
    // $timestamp = strtotime($dateString);
    // $newTimestamp = strtotime('-1 month', $timestamp);
    // $newDateString = date('Y-m', $newTimestamp);
    // $newDateString = (string) $newDateString;

    // // echo json_encode($newDateString);

    // $humanRef = $database->getReference('Hpenjualan');
    // $snapshot = $humanRef->getSnapshot();

    // $data = $snapshot->getValue();

    // $filteredData = array_filter($data, function($item) {
    //     $dateString = '2023-10';
    //     $timestamp = strtotime($dateString);
    //     $newTimestamp = strtotime('-1 month', $timestamp);
    //     $newDateString = date('Y-m', $newTimestamp);
    //     $newDateString = (string) $newDateString;
    //     return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    // });

    // $totalm1 = 0;

    // foreach ($filteredData as $key => $item) {
    //     foreach ($item['list_id_Barang'] as $key => $item) {
    //         if ($item['key'] == "-NU2g8nxd5ppge8BsspK") {
    //             $totalm1 += $item['stok_dijual'];
    //         }
    //     }
    // }

    // $filteredData = array_filter($data, function($item) {
    //     $dateString = '2023-10';
    //     $timestamp = strtotime($dateString);
    //     $newTimestamp = strtotime('-2 month', $timestamp);
    //     $newDateString = date('Y-m', $newTimestamp);
    //     $newDateString = (string) $newDateString;
    //     return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    // });

    // $totalm2 = 0;

    // foreach ($filteredData as $key => $item) {
    //     foreach ($item['list_id_Barang'] as $key => $item) {
    //         if ($item['key'] == "-NU2g8nxd5ppge8BsspK") {
    //             $totalm2 += $item['stok_dijual'];
    //         }
    //     }
    // }
    
    // // echo json_encode($filteredData[0]['list_id_Barang'][0]['nama_barang']);
    // // echo json_encode($filteredData);
    // // echo json_encode($totalm1);
    // // echo json_encode($totalm2);

    // $a = 5;
    // $b = 10;

    // echo json_encode(abs($a - $b));




    // $Refhpembelian = $database->getReference('Hpembelian_stok');
    // $snapshot = $Refhpembelian->getSnapshot();

    // $data = $snapshot->getValue();

    // $leadtime = 0;
    // $matchidcount = 0;

    // foreach ($data as $key => $item) {
    //     // $ref_tabledistribusi = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
    //     // $fetchdatadistribusi = $database->getReference($ref_tabledistribusi)->getValue();

    //     if ($item['id_Barang'] == "-NU2g8nxd5ppge8BsspK") {
    //         // // Update the array with the retrieved data
    //         // $fetchdatadetailpenjualan[$key]['nama_pembeli'] = $fetchdatadistribusi['nama_pembeli'];
    //         // $fetchdatadetailpenjualan[$key]['foto_pembeli'] = $fetchdatadistribusi['foto_pembeli'];
    //         // $fetchdatadetailpenjualan[$key]['savedetail_address'] = $fetchdatadistribusi['savedetail_address'];
    //         // $fetchdatadetailpenjualan[$key]['savelatitude'] = $fetchdatadistribusi['savelatitude'];
    //         // $fetchdatadetailpenjualan[$key]['savelongitude'] = $fetchdatadistribusi['savelongitude'];
            
    //         $ref_tablepembelian = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
    //         $fetchdatapembelian = $database->getReference($ref_tablepembelian)->getValue();

    //         if (date("Ym", strtotime("2023-10")) == date("Ym", strtotime($fetchdatapembelian['tanggal_pembelian']))) {
    //             $matchidcount++;
    //             $leadtime += $fetchdatapembelian['lama_pembelian'];
    //         }


    //     }
    // }

    // $average = $leadtime / $matchidcount;
    // echo json_encode($average);


    // $data = array(2, 4, 6, 8, );
    // $standard_deviation = stats_standard_deviation($data);
    // echo "The standard deviation is: " . $standard_deviation;

    // function standard_deviation($arr) {
    //     $num_of_elements = count($arr);
    //     $variance = 0.0;
    //     $average = array_sum($arr)/$num_of_elements;
    //     foreach($arr as $i) {
    //         $variance += pow(($i - $average), 2);
    //     }
    //     return (float)sqrt($variance/$num_of_elements);
    // }
    
    // $data = array(2, 4, 6, 8);
    // $standard_deviation = standard_deviation($data);
    // echo "The standard deviation is: " . $standard_deviation;

    $number = 16;
    $square_root = sqrt(12157.6872);
    echo "The square root of 6210,5865 + 5947,1007 is " . $square_root;
    
    
    
?>