<?php
    include('../../db.php');
                                    
    $ref_table = 'inventory';
    $fetchdata = $database->getReference($ref_table)->getValue();

    $arr = [];
    if($fetchdata > 0){
        $i = 0;
        foreach($fetchdata as $key => $row){
            array_push($arr, $row);
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