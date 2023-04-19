<?php
    include('../../db.php');
                                    
    $ref_table = 'inventory';
    $fetchdata = $database->getReference($ref_table)->getValue();

    $arr = [];
    // if($fetchdata > 0){
    //     $i = 0;
    //     foreach($fetchdata as $key => $row){
    //         array_push($arr, $row);
    //     }
    // }

    $co = 0;
    if($fetchdata > 0){
        $i = 0;
        // try {
            
        // }
        // catch(Exception $e) {}
        foreach($fetchdata as $key => $row){
            // echo $row['halo'];
            // echo $row['ngoods'];
            // echo "<br>";
            // echo sizeof($row);
            // echo "<br>";
            // echo 'co'.$co;
            try {
                if(sizeof($row) == 6){
                    throw new Exception("Value must be 1 or below");
                }else{
                    $arr[$co] = array(
                        'key' => $key,
                        'halo' => $row['halo'],
                        'deskripsi' => $row['dgoods'],
                        'foto' => $row['fgoods'],
                        'kategori' => $row['kgoods'],
                        'nama' => $row['ngoods'],
                        'harga' => $row['pgoods'],
                        'stok' => $row['sgoods'],
                    );
                }
            } 
            catch(Exception $e) {
                $arr[$co] = array(
                    'key' => $key,
                    'halo' => "",
                    'deskripsi' => $row['dgoods'],
                    'foto' => $row['fgoods'],
                    'kategori' => $row['kgoods'],
                    'nama' => $row['ngoods'],
                    'harga' => $row['pgoods'],
                    'stok' => $row['sgoods'],
                );
            }   
            $co++;
        }
    }

    echo json_encode($arr);


    // if( $conn === false ) {
    //     die( print_r( sqlsrv_errors(), true));
    // }

    // $sql = "SELECT * FROM dbo.mCabang INNER JOIN mKlaster ON dbo.mCabang.id_klaster=dbo.mKlaster.id_klaster";
    // $stmt = sqlsrv_query( $conn, $sql );
    // if( $stmt === false) {
    //     die( print_r( sqlsrv_errors(), true) );
    // }

    // $arr = [];
    // while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //     array_push($arr, $row);
    // }

    // sqlsrv_free_stmt($stmt);

	// echo json_encode($arr);
?>