<?php
    include('../../db.php');
                                    
    $ref_table = 'distribusi';
    $fetchdata = $database->getReference($ref_table)->getValue();

    $arr = [];
    $co = 0;
    if($fetchdata > 0){
        $i = 0;
        foreach($fetchdata as $key => $row){
            $arr[$co] = array(
                'key' => $key,
                'alamat_pembeli' => $row['alamat_pembeli'],
                'deskripsi_pembeli' => $row['deskripsi_pembeli'],
                'foto_pembeli' => $row['foto_pembeli'],
                'nama_pembeli' => $row['nama_pembeli'],
            );
            $co++;
        }
    }

    echo json_encode($arr);

?>