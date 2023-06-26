<?php

    session_start();
    include('../../db.php');
    require_once('../../distribusi/google-calendar-api.php');

    // Normal Data
    $detailpengirimanid = $_POST["detailpengirimanid"];
    $notaid = $_POST["notaid"];

    // session data
    $accessToken = $_SESSION['access_token'];


    // get google pembayaran id
    $calendarpembayaranRef = $database->getReference('Calendar_pembayaran')->getSnapshot();

    $googlepembayaranid = null;
    $keypembayaran = null;

    foreach ($calendarpembayaranRef->getValue() as $key => $valuepem) {
        if ($valuepem['id_Detail_penjualan'] == $detailpengirimanid) {
            $keypembayaran = $key;
            $googlepembayaranid = $valuepem['google_calendar_id'];
            break;
        }
    }

    // get google penjualan id
    $calendarpenjualanRef = $database->getReference('Calendar_penjualan')->getSnapshot();

    $googlepenjualanid = null;
    $keypenjualan = null;

    foreach ($calendarpenjualanRef->getValue() as $key => $valuepen) {
        if ($valuepen['id_Detail_penjualan'] == $detailpengirimanid) {
            $keypenjualan = $key;
            $googlepenjualanid = $valuepen['google_calendar_id'];
            break;
        }
    }


    // delete event on google calendar //
    // event penjualan
    $headersPenjualan = [
        "Authorization: Bearer {$accessToken}",
    ];

    $eventIPenjualan = $googlepenjualanid;

    $urlPenjualan = 'https://www.googleapis.com/calendar/v3/calendars/primary/events/' . $eventIPenjualan;

    $chPenjualan = curl_init($urlPenjualan);
    curl_setopt($chPenjualan, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($chPenjualan, CURLOPT_HTTPHEADER, $headersPenjualan);
    curl_setopt($chPenjualan, CURLOPT_RETURNTRANSFER, true);
    $responsePenjualan = curl_exec($chPenjualan);
    curl_close($chPenjualan);

    // event pembayaran
    $headersPembayaran = [
        "Authorization: Bearer {$accessToken}",
    ];

    $eventIdPembayaran = $googlepembayaranid;

    $urlPembayaran = 'https://www.googleapis.com/calendar/v3/calendars/primary/events/' . $eventIdPembayaran;

    $chPembayaran = curl_init($urlPembayaran);
    curl_setopt($chPembayaran, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($chPembayaran, CURLOPT_HTTPHEADER, $headersPembayaran);
    curl_setopt($chPembayaran, CURLOPT_RETURNTRANSFER, true);
    $responsePembayaran = curl_exec($chPembayaran);
    curl_close($chPembayaran);



    // delete calendar_pembayaran
    $database->getReference('Calendar_pembayaran/'. $keypembayaran)->remove();

    // delete calendar_penjualan
    $database->getReference('Calendar_penjualan/'. $keypenjualan)->remove();

    // delete Hpenjualan
    $HpenjualanRef = $database->getReference('Hpenjualan')->getSnapshot();

    $keyHpenjualan = null;

    foreach ($HpenjualanRef->getValue() as $key => $valuejual) {
        if ($valuejual['id_Detail_penjualan'] == $detailpengirimanid) {
            $keyHpenjualan = $key;
            break;
        }
    }

    $database->getReference('Hpenjualan/'. $keyHpenjualan)->remove();


    // get id pengingat and catatan
    $ref_tablenota = 'Nota_penjualan/' . $notaid;
    $fetchdatanota = $database->getReference($ref_tablenota)->getValue();

    $pengingatid = $fetchdatanota["id_Pengingat"];
    $catatanid = $fetchdatanota["id_Catatan"];

    // $arr = [];
    // $co = 0;
    // if($fetchdatanota > 0){
    //     $i = 0;
    //     foreach($fetchdatanota as $key => $row){
    //         // $arr[$co] = array(
    //         //     'nama_barang' => $row['nama_barang'],
    //         //     'stok_dijual' => $row['stok_dijual'],
    //         // );
    //         // $co++;
    //         $pengingatid = $row['id_Pengingat'];
    //         $catatanid = $row['id_Catatan'];
    //     }
    // }

    // delete Pengingat
    $database->getReference('Pengingat/'. $pengingatid)->remove();

    // delete Catatan
    $database->getReference('Catatan/'. $catatanid)->remove();

    // delete Nota
    $database->getReference('Nota_penjualan/'. $notaid)->remove();

    // delete Detail_penjualan
    $database->getReference('Detail_penjualan/'. $detailpengirimanid)->remove();





?>