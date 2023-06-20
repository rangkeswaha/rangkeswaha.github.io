<?php
    include('../../db.php');

    $keyhotel = $_POST["keyhotel"];
    // $keyhotel = "-NUXqJ7Zo9WpgsGho-8-";
    $totalberat = 0;

    $ref_tabledetailpenjualan = 'Detail_penjualan/';
    $fetchdatadetailpenjualan = $database->getReference($ref_tabledetailpenjualan)->getValue();

    foreach ($fetchdatadetailpenjualan as $key => $item) {
        $ref_tablenota = 'Nota_penjualan/' . $item['id_Nota_penjualan'];
        $fetchdatanota = $database->getReference($ref_tablenota)->getValue();
    
        // Check if the retrieved data is not empty
        if ($item['id_Distribusi'] == $keyhotel) {
            foreach ($fetchdatanota['list_barang'] as $key2 => $item2) {
                $totalberat += $item2['stok_dijual'];
            }
        }
    }
    
    echo json_encode($totalberat);
?>