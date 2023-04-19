<?php
    include('../../db.php');
                                        
    $ref_table = 'mkategori';
    $fetchdata = $database->getReference($ref_table)->getValue();

    $arr = [];
    $co = 0;
    if($fetchdata > 0){
        $i = 0;
        foreach($fetchdata as $key => $row){
            $temp = $row['kategori'];
            $arr[$co] = array(
                'key' => $key,
                'kategori' => $temp,
            );
            $co++;
        }
    }

    echo json_encode($arr);

	// require_once "../connect.php";

    // if( $conn === false ) {
    //     die( print_r( sqlsrv_errors(), true));
    // }

    // $sql = "SELECT * FROM dbo.mTipeLogin";
    // $stmt = sqlsrv_query( $conn, $sql );
    // if( $stmt === false) {
    //     die( print_r( sqlsrv_errors(), true) );
    // }

    // $arr = [];
    // $co = 0;
    // while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //     // echo $row['last_login'];
    //     $co++;
    //     array_push($arr, $row);
    // }

    // $i = 0;
    // while ($i != $co){
    //     $temp = explode(" " ,$arr[$i]['last_login']);
    //     // echo $temp[0];
    //     $arr[$i]['last_login'] = $temp[0];
    //     $i++;
    // }

    // sqlsrv_free_stmt($stmt);

	// echo json_encode($arr);
?>
