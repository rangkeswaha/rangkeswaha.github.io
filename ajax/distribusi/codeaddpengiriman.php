<?php 
    session_start();
    include('../../db.php');

    // $dataorder = [
    //     [
    //         'saledategoods' => 'item1',
    //         'paydategoods' => 10,
    //     ],
    //     [
    //         'saledategoods' => 'item2',
    //         'paydategoods' => 20,
    //     ],
    // ];

    // $notegoods = "Hello World";


    // normal data
    $notegoods = $_POST["notegoods"];
    $diskey = $_POST["diskey"];
    $disnama = $_POST["disnama"];
    $disfoto = $_POST["disfoto"];
    $disalamat = $_POST["disalamat"];
    $disdetailaddress = $_POST["disdetailaddress"];
    $dislatitude = $_POST["dislatitude"];
    $dislongitude = $_POST["dislongitude"];
    // $disdeskripsi = $_POST["disdeskripsi"];
    $disdeskripsi = htmlentities($_POST['disdeskripsi']);

    // array data
    $tempdata = $_POST["dataorder"];
    $dataorder = json_decode($tempdata, true);

    // push data into database //

    // catatan
    $propertiesnote = [
        'catatan_penjualan' => $notegoods,
    ];

    $ref_table1 = "Catatan";
    $postRef_result1 = $database->getReference($ref_table1)->push($propertiesnote);

    $newidnote = $postRef_result1->getKey();
    // echo 'New data ID: ' . $pembelianstoknewid;

    // pengingat
    $propertiespengingat = [
        'tanggal_pengiriman' => $dataorder[0]['saledategoods'],
        'tanggal_pembayaran' => $dataorder[0]['paydategoods'],
    ];

    $ref_table2 = "Pengingat";
    $postRef_result2 = $database->getReference($ref_table2)->push($propertiespengingat);

    $newidpengingat = $postRef_result2->getKey();
    // echo 'New data ID: ' . $pembelianstoknewid;

    // nota
    foreach ($dataorder as &$item) {
        $item['nama_barang'] = $item['namegoods'];
        unset($item['namegoods']);
        $item['stok_dijual'] = $item['stockgoods'];
        unset($item['stockgoods']);
        $item['tanggal_bayar'] = $item['paydategoods'];
        unset($item['paydategoods']);
        $item['tanggal_dijual'] = $item['saledategoods'];
        unset($item['saledategoods']);
        $item['stok_awal'] = $item['firststockgoods'];
        unset($item['firststockgoods']);
        $item['harga_barang'] = $item['pricegoods'];
        unset($item['pricegoods']);
    }

    $propertiesnota = [
        'id_Pengingat' => $newidpengingat,
        'id_Catatan' => $newidnote,
        'nama_pembeli' => $disnama,
        'list_barang' => $dataorder,
    ];
    
    $ref_table3 = "Nota_penjualan";
    $postRef_result3 = $database->getReference($ref_table3)->push($propertiesnota);

    $newidnota = $postRef_result3->getKey();
    // echo 'New data ID: ' . $pembelianstoknewid;

    // detail penjualan
    // Loop through the array and calculate the total price
    $totalPrice = 0;
    $totalPrice = array_reduce($dataorder, function($acc, $item) {
        return $acc + ($item['harga_barang'] * $item['stok_dijual']);
    }, 0);

    $totalBarang = count($dataorder);

    $propertiesdetailpenjualan = [
        'id_Distribusi' => $diskey,
        'id_Nota_penjualan' => $newidnota,
        'total_harga' => $totalPrice,
        'jumlah_barang' => $totalBarang,
        'status_penjualan' => "Proses Pengiriman",
        'alamat_pengiriman' => $disdetailaddress,
    ];
    
    $ref_table4 = "Detail_penjualan";
    $postRef_result4 = $database->getReference($ref_table4)->push($propertiesdetailpenjualan);

    $newiddetailpenjualan = $postRef_result4->getKey();
    // echo 'New data ID: ' . $pembelianstoknewid;
    
    // history penjualan
    $propertieshpenjualan = [
        'list_id_Barang' => $dataorder,
        'id_Detail_penjualan' => $newiddetailpenjualan,
        'tanggal_penjualan' => $dataorder[0]['tanggal_dijual'],
    ];
    
    $ref_table5 = "Hpenjualan";
    $postRef_result5 = $database->getReference($ref_table5)->push($propertieshpenjualan);

    $newidhpenjualan = $postRef_result5->getKey();
    // echo 'New data ID: ' . $pembelianstoknewid;


    // Input data calendar into account calendar //
    require_once('../../distribusi/google-calendar-api.php');
    $tempevent = $_POST["parameters"];
    $event = json_decode($tempevent, true);

    $title = $event['title'];
    $location = $event['location'];
    $description = $event['description'];
    $start_time = $event['event_time']['start_time'];
    $end_time = $event['event_time']['end_time'];
    $event_date = $event['event_time']['event_date'];
    $all_day = $event['all_day'];

    try {
        // Get event details
        // $event = $_POST['event_details'];
        // $tempevent = $_POST["event_details"];
        // $event = json_decode($tempevent, true);


        $capi = new GoogleCalendarApi();

        // Get user calendar timezone
        $user_timezone = $capi->GetUserCalendarTimezone($_SESSION['access_token']);

        // Create event on primary calendar
        $event_id = $capi->CreateCalendarEvent('primary', $title, $all_day, $event['event_time'], $user_timezone, $_SESSION['access_token'],  $location,  $description);
        
        // echo json_encode([ 'event_id' => $_SESSION['access_token'] ]);
        // echo json_encode($_SESSION['access_token']);
    }
    catch(Exception $e) {
        header('Bad Request', true, 400);
        echo json_encode(array( 'error' => 1, 'message' => $e->getMessage() ));
    }

    // Input Data Calendar into Database //
    $propertiescalendarpenjualan = [
        'id_Detail_penjualan' => $newiddetailpenjualan,
        'title' => $title,
        'description' => $description,
        'location' => $location,
        'date' => $event_date,
        'time_from' => $start_time,
        'time_to' => $end_time,
        'google_calendar_id' => $_SESSION['access_token'],
    ];
    
    $ref_table6 = "Calendar_penjualan";
    $postRef_result6 = $database->getReference($ref_table6)->push($propertiescalendarpenjualan);

    $newidcalendarpenjualan = $postRef_result6->getKey();
    // echo 'New data ID: ' . $pembelianstoknewid;





    
    // $allnewkeys = array();

    // for($i = 0; $i < count((array)$data); $i++){
    //     $totalstock = 0;
        
    //     $properties = [
    //         'lama_pembelian' => $data[$i]['buylengthgoods'],
    //         'tanggal_pembelian' => $data[$i]['buydategoods'],
    //         'jumlah_barang' => $data[$i]['stockgoods'],
    //     ];

    //     $ref_table = "Pembelian_stok";
    //     $postRef_result = $database->getReference($ref_table)->push($properties);

    //     $pembelianstoknewid = $postRef_result->getKey();
    //     // echo 'New data ID: ' . $pembelianstoknewid;

    //     // Total stok (stok baru)
    //     $totalstock = $data[$i]['firststockgoods'] + $data[$i]['stockgoods'];

    //     // ID barang
    //     $uid = $data[$i]['key'];

    //     $properties_history = [
    //         'id_Barang' => $uid,
    //         'id_Pembelian_Stok' => $pembelianstoknewid,
    //         'stok_sebelumnya' => $data[$i]['firststockgoods'],
    //         'stok_baru' => $totalstock,
    //     ];

    //     $ref_table_history = "Hpembelian_stok";
    //     $postRef_result_history = $database->getReference($ref_table_history)->push($properties_history);


    //     $ref = $database->getReference('inventory');

    //     $ref->getChild($uid)->update(['stok_barang' => $totalstock]);


    //     $totalstock = 0;
   
    // }

?>