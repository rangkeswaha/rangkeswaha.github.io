<?php
    include('../../db.php');

    // use Firebase\Firebase;
    // use Firebase\Auth\TokenGenerator;
    
    $status = $_POST["status"];
    $key = $_POST["key"];
    // // echo json_encode($key);

    // // Update the name property in the data with ID 123
    // $newName = "Morty Smith";
    // $id = "123";

    // // Build the reference path
    // $refPath = 'Detail_penjualan/' . $key . '/status_penjualan';

    // // Update the name property at the specified database reference
    // $database->update($refPath, ['status_penjualan' => $status]);

    $updatedata = [
        'status_penjualan'=> $status,
    ];

    $reftable = 'Detail_penjualan/' . $key;
    $database->getReference($reftable)->update($updatedata);

?>