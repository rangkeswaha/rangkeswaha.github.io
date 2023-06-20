<?php
    include('../../db.php');

    $keyhotel = $_POST["keyhotel"];
    // $keyhotel = "-NUXqJ7Zo9WpgsGho-8-";
    $totalberat = 0;
    $arrdata = [];
    $co = 0;

    $ref_tabledetailpenjualan = 'Detail_penjualan/';
    $fetchdatadetailpenjualan = $database->getReference($ref_tabledetailpenjualan)->getValue();

    foreach ($fetchdatadetailpenjualan as $key => $item) {
        $ref_tablenota = 'Nota_penjualan/' . $item['id_Nota_penjualan'];
        $fetchdatanota = $database->getReference($ref_tablenota)->getValue();
    
        // Check if the retrieved data is not empty
        if ($item['id_Distribusi'] == $keyhotel) {
            $tglbayar;
            $tgldijual;
            foreach ($fetchdatanota['list_barang'] as $key2 => $item2) {
                $totalberat += $item2['stok_dijual'];
                $tglbayar = $item2['tanggal_bayar'];
                $tgldijual = $item2['tanggal_dijual'];
            }
            $arr[$co] = array(
                'key' => $key,
                'status_penjualan' => $item['status_penjualan'],
                'jumlah_barang' => $item['status_penjualan'],
                'total_berat' => $totalberat,
                'total_harga' => $item['total_harga'],
                'tanggal_bayar' => $tglbayar,
                'tanggaldijual' => $tgldijual,
            );
            $co++;
            $totalberat = 0;
        }
    }
    
    echo json_encode($arr);
?>