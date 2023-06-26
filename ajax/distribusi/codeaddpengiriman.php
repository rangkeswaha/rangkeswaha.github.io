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


    // Input data pengiriman calendar into account calendar //
    require_once('../../distribusi/google-calendar-api.php');
    $accessToken = $_SESSION['access_token'];


    // cara baru google calendar start //
    // add event penjualan in google calendar
    // event id harus disimpan pada database untuk kebutuhan penghapusan

    try{

        $headers = [
            'Content-Type: application/json',
            "Authorization: Bearer {$accessToken}",
        ];
    
        $tempevent = $_POST["parameters"];
        $eventfetch = json_decode($tempevent, true);
    
        $title = $eventfetch['title'];
        $location = $eventfetch['location'];
        $description = $eventfetch['description'];
        $start_time = $eventfetch['event_time']['start_time'];
        $end_time = $eventfetch['event_time']['end_time'];
        $event_date = $eventfetch['event_time']['event_date'];
        $all_day = $eventfetch['all_day'];
    
        $event = [
            'summary' => $title,
            'start' => [
                "dateTime" => $start_time,
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                "dateTime" => $end_time,
                'timeZone' => 'Asia/Jakarta',
            ],
            'location' => $location,
            'description' => $description,
        ];
    
        $eventJson = json_encode($event);
    
        $url = 'https://www.googleapis.com/calendar/v3/calendars/primary/events';
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $eventJson);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        if ($response) {
            $responseData = json_decode($response, true);
            $eventId = $responseData['id'];
            echo "Event added successfully. Event ID: " . $eventId;
    
            // Input Data Calendar into Database Calendar_penjualan //
            $propertiescalendarpenjualan = [
                'id_Detail_penjualan' => $newiddetailpenjualan,
                'title' => $title,
                'description' => $description,
                'location' => $location,
                'date' => $event_date,
                'time_from' => $start_time,
                'time_to' => $end_time,
                // 'google_calendar_id' => $_SESSION['access_token'],
                'google_calendar_id' => $eventId,
            ];
            
            $ref_table6 = "Calendar_penjualan";
            $postRef_result6 = $database->getReference($ref_table6)->push($propertiescalendarpenjualan);
    
            $newidcalendarpenjualan = $postRef_result6->getKey();
            // // echo 'New data ID: ' . $pembelianstoknewid;
    
        }

    }
    catch(Exception $e) {
        header('Bad Request', true, 400);
        echo json_encode(array( 'error' => 1, 'message' => $e->getMessage() ));
    }



    // add event pembayaran in google calendar
    // event id harus disimpan pada database untuk kebutuhan penghapusan

    try{

        $headerspay = [
            'Content-Type: application/json',
            "Authorization: Bearer {$accessToken}",
        ];
    
        $tempeventpay = $_POST["parametersPembayaran"];
        $eventfetchpay = json_decode($tempeventpay, true);
    
        $titlepay = $eventfetchpay['title'];
        $locationpay = $eventfetchpay['location'];
        $descriptionpay = $eventfetchpay['description'];
        $start_timepay = $eventfetchpay['event_time']['start_time'];
        $end_timepay = $eventfetchpay['event_time']['end_time'];
        $event_datepay = $eventfetchpay['event_time']['event_date'];
        $all_daypay = $eventfetchpay['all_day'];
    
        $eventpay = [
            'summary' => $titlepay,
            'start' => [
                "dateTime" => $start_timepay,
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                "dateTime" => $end_timepay,
                'timeZone' => 'Asia/Jakarta',
            ],
            'location' => $locationpay,
            'description' => $descriptionpay,
        ];
    
        $eventJsonpay = json_encode($eventpay);
    
        $urlpay = 'https://www.googleapis.com/calendar/v3/calendars/primary/events';
    
        $chpay = curl_init($urlpay);
        curl_setopt($chpay, CURLOPT_POST, true);
        curl_setopt($chpay, CURLOPT_HTTPHEADER, $headerspay);
        curl_setopt($chpay, CURLOPT_POSTFIELDS, $eventJsonpay);
        curl_setopt($chpay, CURLOPT_RETURNTRANSFER, true);
        $responsepay = curl_exec($chpay);
        curl_close($chpay);
    
        if ($responsepay) {
            $responseDatapay = json_decode($responsepay, true);
            $eventIdpay = $responseDatapay['id'];
            // echo "Event added successfully. Event ID: " . $eventId;
    
            // Input Data Calendar into Database Calendar_penjualan //
            $propertiescalendarpembayaran = [
                'id_Detail_penjualan' => $newiddetailpenjualan,
                'title' => $titlepay,
                'description' => $descriptionpay,
                'location' => $locationpay,
                'date' => $event_datepay,
                'time_from' => $start_timepay,
                'time_to' => $end_timepay,
                // 'google_calendar_id' => $_SESSION['access_token'],
                'google_calendar_id' => $eventIdpay,
            ];
            
            $ref_tablepay = "Calendar_pembayaran";
            $postRef_resultpay = $database->getReference($ref_tablepay)->push($propertiescalendarpembayaran);
    
            $newidcalendarpembayaran = $postRef_resultpay->getKey();
            // // echo 'New data ID: ' . $pembelianstoknewid;
    
        }

    }
    catch(Exception $e) {
        header('Bad Request', true, 400);
        echo json_encode(array( 'error' => 1, 'message' => $e->getMessage() ));
    }





    // cara baru google calendar end //




    // cara awal google calendar start //
    // $tempevent = $_POST["parameters"];
    // $event = json_decode($tempevent, true);

    // $title = $event['title'];
    // $location = $event['location'];
    // $description = $event['description'];
    // $start_time = $event['event_time']['start_time'];
    // $end_time = $event['event_time']['end_time'];
    // $event_date = $event['event_time']['event_date'];
    // $all_day = $event['all_day'];

    // $event_id;

    // try {
    //     // Get event details
    //     // $event = $_POST['event_details'];
    //     // $tempevent = $_POST["event_details"];
    //     // $event = json_decode($tempevent, true);


    //     $capi = new GoogleCalendarApi();

    //     // Get user calendar timezone
    //     $user_timezone = $capi->GetUserCalendarTimezone($_SESSION['access_token']);

    //     // Create event on primary calendar
    //     $event_id = $capi->CreateCalendarEvent('primary', $title, $all_day, $event['event_time'], $user_timezone, $_SESSION['access_token'],  $location,  $description);
        
    //     // echo json_encode([ 'event_id' => $_SESSION['access_token'] ]);
    //     // echo json_encode($_SESSION['access_token']);
    // }
    // catch(Exception $e) {
    //     header('Bad Request', true, 400);
    //     echo json_encode(array( 'error' => 1, 'message' => $e->getMessage() ));
    // }

    // // Input data pembayaran calendar into account calendar //
    // $paytempevent = $_POST["parametersPembayaran"];
    // $payevent = json_decode($paytempevent, true);

    // $paytitle = $payevent['title'];
    // $paylocation = $payevent['location'];
    // $paydescription = $payevent['description'];
    // $paystart_time = $payevent['event_time']['start_time'];
    // $payend_time = $payevent['event_time']['end_time'];
    // $payevent_date = $payevent['event_time']['event_date'];
    // $payall_day = $payevent['all_day'];

    // try {

    //     $paycapi = new GoogleCalendarApi();

    //     // Get user calendar timezone
    //     $payuser_timezone = $paycapi->GetUserCalendarTimezone($_SESSION['access_token']);

    //     // Create event on primary calendar
    //     $payevent_id = $paycapi->CreateCalendarEvent('primary', $paytitle, $payall_day, $payevent['event_time'], $payuser_timezone, $_SESSION['access_token'],  $paylocation,  $paydescription);
        
    // }
    // catch(Exception $e) {
    //     header('Bad Request', true, 400);
    //     echo json_encode(array( 'error' => 1, 'message' => $e->getMessage() ));
    // }


    // // Input Data Calendar into Database Calendar_penjualan //
    // $propertiescalendarpenjualan = [
    //     'id_Detail_penjualan' => $newiddetailpenjualan,
    //     'title' => $title,
    //     'description' => $description,
    //     'location' => $location,
    //     'date' => $event_date,
    //     'time_from' => $start_time,
    //     'time_to' => $end_time,
    //     // 'google_calendar_id' => $_SESSION['access_token'],
    //     'google_calendar_id' => $event_id,
    // ];
    
    // $ref_table6 = "Calendar_penjualan";
    // $postRef_result6 = $database->getReference($ref_table6)->push($propertiescalendarpenjualan);

    // $newidcalendarpenjualan = $postRef_result6->getKey();
    // // echo 'New data ID: ' . $pembelianstoknewid;

    // cara awal google calendar end //





    
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