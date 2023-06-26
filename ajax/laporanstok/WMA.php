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

    // get 6 months behind
    // $dateString = '2023-10';
    $timestamp = strtotime($keybulan);
    $newTimestamp = strtotime('-1 month', $timestamp);
    $month1 = date('Y-m', $newTimestamp);

    // $dateString = '2023-10';
    $timestamp = strtotime($keybulan);
    $newTimestamp = strtotime('-2 month', $timestamp);
    $month2 = date('Y-m', $newTimestamp);

    // $dateString = '2023-10';
    $timestamp = strtotime($keybulan);
    $newTimestamp = strtotime('-3 month', $timestamp);
    $month3 = date('Y-m', $newTimestamp);

    // $dateString = '2023-10';
    $timestamp = strtotime($keybulan);
    $newTimestamp = strtotime('-4 month', $timestamp);
    $month4 = date('Y-m', $newTimestamp);

    // $dateString = '2023-10';
    $timestamp = strtotime($keybulan);
    $newTimestamp = strtotime('-5 month', $timestamp);
    $month5 = date('Y-m', $newTimestamp);

    // $dateString = '2023-10';
    $timestamp = strtotime($keybulan);
    $newTimestamp = strtotime('-6 month', $timestamp);
    $month6 = date('Y-m', $newTimestamp);

    // echo json_encode($newDateString);


    // get total penjualan
    $Refhpenjualan = $database->getReference('Hpenjualan');
    $snapshot = $Refhpenjualan->getSnapshot();

    $data = $snapshot->getValue();

    // month -1
    $filteredData = array_filter($data, function($item) {
        $keybulan = $_POST["keybulan"];
        $timestamp = strtotime($keybulan);
        $newTimestamp = strtotime('-1 month', $timestamp);
        $month1 = date('Y-m', $newTimestamp);
        $newDateString = (string) $month1;
        return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    });

    $totalm1 = 0;

    foreach ($filteredData as $key => $item) {
        foreach ($item['list_id_Barang'] as $key => $item) {
            if ($item['key'] == $keybarang) {
                $totalm1 += $item['stok_dijual'];
            }
        }
    }

    // month -2
    $filteredData = array_filter($data, function($item) {
        $keybulan = $_POST["keybulan"];
        $timestamp = strtotime($keybulan);
        $newTimestamp = strtotime('-2 month', $timestamp);
        $month1 = date('Y-m', $newTimestamp);
        $newDateString = (string) $month1;
        return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    });

    $totalm2 = 0;

    foreach ($filteredData as $key => $item) {
        foreach ($item['list_id_Barang'] as $key => $item) {
            if ($item['key'] == $keybarang) {
                $totalm2 += $item['stok_dijual'];
            }
        }
    }

    // month -3
    $filteredData = array_filter($data, function($item) {
        $keybulan = $_POST["keybulan"];
        $timestamp = strtotime($keybulan);
        $newTimestamp = strtotime('-3 month', $timestamp);
        $month1 = date('Y-m', $newTimestamp);
        $newDateString = (string) $month1;
        return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    });

    $totalm3 = 0;

    foreach ($filteredData as $key => $item) {
        foreach ($item['list_id_Barang'] as $key => $item) {
            if ($item['key'] == $keybarang) {
                $totalm3 += $item['stok_dijual'];
            }
        }
    }

    // month -4
    $filteredData = array_filter($data, function($item) {
        $keybulan = $_POST["keybulan"];
        $timestamp = strtotime($keybulan);
        $newTimestamp = strtotime('-4 month', $timestamp);
        $month1 = date('Y-m', $newTimestamp);
        $newDateString = (string) $month1;
        return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    });

    $totalm4 = 0;

    foreach ($filteredData as $key => $item) {
        foreach ($item['list_id_Barang'] as $key => $item) {
            if ($item['key'] == $keybarang) {
                $totalm4 += $item['stok_dijual'];
            }
        }
    }

    // month -5
    $filteredData = array_filter($data, function($item) {
        $keybulan = $_POST["keybulan"];
        $timestamp = strtotime($keybulan);
        $newTimestamp = strtotime('-5 month', $timestamp);
        $month1 = date('Y-m', $newTimestamp);
        $newDateString = (string) $month1;
        return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    });

    $totalm5 = 0;

    foreach ($filteredData as $key => $item) {
        foreach ($item['list_id_Barang'] as $key => $item) {
            if ($item['key'] == $keybarang) {
                $totalm5 += $item['stok_dijual'];
                // echo json_encode("masuk - 5");
            }
        }
    }

    // month -6
    $filteredData = array_filter($data, function($item) {
        $keybulan = $_POST["keybulan"];
        $timestamp = strtotime($keybulan);
        $newTimestamp = strtotime('-6 month', $timestamp);
        $month1 = date('Y-m', $newTimestamp);
        $newDateString = (string) $month1;
        return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    });

    $totalm6 = 0;

    foreach ($filteredData as $key => $item) {
        foreach ($item['list_id_Barang'] as $key => $item) {
            if ($item['key'] == $keybarang) {
                $totalm6 += $item['stok_dijual'];
                // echo json_encode("masuk - 6");
            }
        }
    }

    // ramalan 3 data
    $ramalan3 = (($totalm6*1) + ($totalm5*2) + ($totalm4*3)) / 6;
    $ramalan2 = (($totalm5*1) + ($totalm4*2) + ($totalm3*3)) / 6;
    $ramalan1 = (($totalm4*1) + ($totalm3*2) + ($totalm2*3)) / 6;
    $ramalan0 = (($totalm3*1) + ($totalm2*2) + ($totalm1*3)) / 6;

    // echo json_encode($totalm6);
    // echo json_encode($totalm5);
    // echo json_encode($totalm3);

    $ape1 = abs((($totalm3 - $ramalan3) / $totalm3) * 100);
    $ape2 = abs((($totalm2 - $ramalan2) / $totalm2) * 100);
    $ape3 = abs((($totalm1 - $ramalan1) / $totalm1) * 100);

    $totalape = $ape1 + $ape2 + $ape3;

    $MAPE = $totalape / 3;

    $tempramalan = ($ramalan0 * $MAPE) / 100;
    // $ramalanakhir = $ramalan0 - $tempramalan;

    // $ramalanakhir = 
    
    
    echo json_encode($tempramalan);
?>