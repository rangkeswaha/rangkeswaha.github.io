<?php

session_start();
include('../../db.php');


    // $humanRef = $database->getReference('Hpenjualan');
    // $query = $humanRef->orderByChild('tanggal_penjualan')->startAt('2023-10')->endAt('2023-10\uf8ff');
    // $data = $query->getValue();

    // $humanRef = $database->getReference('Hpenjualan');
    // $snapshot = $humanRef->getSnapshot();

    // $data = $snapshot->getValue();

    // $filteredData = array_filter($data, function($item) {
    //     return strpos($item['tanggal_penjualan'], '2023-10') === 0;
    // });
    
    // echo json_encode($filteredData);

    // $dateString = '2023-10';
    // $timestamp = strtotime($dateString);
    // $newTimestamp = strtotime('-1 month', $timestamp);
    // $newDateString = date('Y-m', $newTimestamp);
    // $newDateString = (string) $newDateString;

    // // echo json_encode($newDateString);

    // $humanRef = $database->getReference('Hpenjualan');
    // $snapshot = $humanRef->getSnapshot();

    // $data = $snapshot->getValue();

    // $filteredData = array_filter($data, function($item) {
    //     $dateString = '2023-10';
    //     $timestamp = strtotime($dateString);
    //     $newTimestamp = strtotime('-1 month', $timestamp);
    //     $newDateString = date('Y-m', $newTimestamp);
    //     $newDateString = (string) $newDateString;
    //     return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    // });

    // $totalm1 = 0;

    // foreach ($filteredData as $key => $item) {
    //     foreach ($item['list_id_Barang'] as $key => $item) {
    //         if ($item['key'] == "-NU2g8nxd5ppge8BsspK") {
    //             $totalm1 += $item['stok_dijual'];
    //         }
    //     }
    // }

    // $filteredData = array_filter($data, function($item) {
    //     $dateString = '2023-10';
    //     $timestamp = strtotime($dateString);
    //     $newTimestamp = strtotime('-2 month', $timestamp);
    //     $newDateString = date('Y-m', $newTimestamp);
    //     $newDateString = (string) $newDateString;
    //     return strpos($item['tanggal_penjualan'], $newDateString) === 0;
    // });

    // $totalm2 = 0;

    // foreach ($filteredData as $key => $item) {
    //     foreach ($item['list_id_Barang'] as $key => $item) {
    //         if ($item['key'] == "-NU2g8nxd5ppge8BsspK") {
    //             $totalm2 += $item['stok_dijual'];
    //         }
    //     }
    // }
    
    // // echo json_encode($filteredData[0]['list_id_Barang'][0]['nama_barang']);
    // // echo json_encode($filteredData);
    // // echo json_encode($totalm1);
    // // echo json_encode($totalm2);

    // $a = 5;
    // $b = 10;

    // echo json_encode(abs($a - $b));




    // $Refhpembelian = $database->getReference('Hpembelian_stok');
    // $snapshot = $Refhpembelian->getSnapshot();

    // $data = $snapshot->getValue();

    // $leadtime = 0;
    // $matchidcount = 0;

    // foreach ($data as $key => $item) {
    //     // $ref_tabledistribusi = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
    //     // $fetchdatadistribusi = $database->getReference($ref_tabledistribusi)->getValue();

    //     if ($item['id_Barang'] == "-NU2g8nxd5ppge8BsspK") {
    //         // // Update the array with the retrieved data
    //         // $fetchdatadetailpenjualan[$key]['nama_pembeli'] = $fetchdatadistribusi['nama_pembeli'];
    //         // $fetchdatadetailpenjualan[$key]['foto_pembeli'] = $fetchdatadistribusi['foto_pembeli'];
    //         // $fetchdatadetailpenjualan[$key]['savedetail_address'] = $fetchdatadistribusi['savedetail_address'];
    //         // $fetchdatadetailpenjualan[$key]['savelatitude'] = $fetchdatadistribusi['savelatitude'];
    //         // $fetchdatadetailpenjualan[$key]['savelongitude'] = $fetchdatadistribusi['savelongitude'];
            
    //         $ref_tablepembelian = 'Pembelian_stok/' . $item['id_Pembelian_Stok'];
    //         $fetchdatapembelian = $database->getReference($ref_tablepembelian)->getValue();

    //         if (date("Ym", strtotime("2023-10")) == date("Ym", strtotime($fetchdatapembelian['tanggal_pembelian']))) {
    //             $matchidcount++;
    //             $leadtime += $fetchdatapembelian['lama_pembelian'];
    //         }


    //     }
    // }

    // $average = $leadtime / $matchidcount;
    // echo json_encode($average);


    // $data = array(2, 4, 6, 8, );
    // $standard_deviation = stats_standard_deviation($data);
    // echo "The standard deviation is: " . $standard_deviation;

    // function standard_deviation($arr) {
    //     $num_of_elements = count($arr);
    //     $variance = 0.0;
    //     $average = array_sum($arr)/$num_of_elements;
    //     foreach($arr as $i) {
    //         $variance += pow(($i - $average), 2);
    //     }
    //     return (float)sqrt($variance/$num_of_elements);
    // }
    
    // $data = array(2, 4, 6, 8);
    // $standard_deviation = standard_deviation($data);
    // echo "The standard deviation is: " . $standard_deviation;

    // $number = 16;
    // $square_root = sqrt(12157.6872);
    // echo "The square root of 6210,5865 + 5947,1007 is " . $square_root;


    // delete event in google calendar //
    require_once('../../distribusi/google-calendar-api.php');
    // first method //
    // $client = new Google_Client();

    // $client->setClientId('143778673708-8itpfmq078q11u3oph2eok4f22nmd0si.apps.googleusercontent.com');
    // $client->setClientSecret('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');
    // $client->setRedirectUri('http://localhost/skripsi/apps/distribusi/google-login.php');
    // $client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);

    // $accessToken = $_SESSION['access_token'];

    // $client->setAccessToken($accessToken);

    // $service = new Google_Service_Calendar($client);

    // $eventId = '-NYonchB0SUhM_eyjbcy';
    // $calendarId = 'primary';

    // $service->events->delete($calendarId, $eventId);

    
    // second method //
    // $eventId = 'c_classroome543c98f@group.calendar.google.com';
    // $calendarId = 'primary';
    // $accessToken = $_SESSION['access_token'];

    // $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events/{$eventId}";

    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //     "Authorization: Bearer {$accessToken}",
    //     "Content-Type: application/json"
    // ]);

    // $response = curl_exec($ch);
    // curl_close($ch);

    // echo $response;
    // // echo $accessToken;


    // if ($response === false) {
    //     echo "Error deleting event.";
    // } else {
    //     echo "Event deleted successfully.";
    // }


    // third method //
    // require_once '../../vendor/autoload.php';

    // $client = new Google_Client();
    // $client->setAuthConfig('../../assets/client_secret_143778673708-8itpfmq078q11u3oph2eok4f22nmd0si.apps.googleusercontent.com.json');
    // $client->addScope(Google_Service_Calendar::CALENDAR);

    // $service = new Google_Service_Calendar($client);

    // $event = new Google_Service_Calendar_Event([
    //     'summary' => 'coba calendar delete 1',
    //     'location' => 'Jl. Nusa Dua, Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali 80361, Indonesia',
    //     'description' => 'coba delete 1',
    //     'start' => [
    //         'dateTime' => '2023-08-07T05:56:00',
    //         'timeZone' => 'Asia/Jakarta',
    //     ],
    //     'end' => [
    //         'dateTime' => '2023-08-07T06:26:00',
    //         'timeZone' => 'Asia/Jakarta',
    //     ],
    // ]);
 
    // $calendarId = 'primary';
    // $event = $service->events->insert($calendarId, $event);

    // fourth method //

    // function addEvent($accessToken, $calendarId, $eventData) {
    //     $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events";
    
    //     $headers = [
    //         "Authorization: Bearer {$accessToken}",
    //         "Content-Type: application/json",
    //     ];
    
    //     $data = json_encode($eventData);
    
    //     $options = [
    //         CURLOPT_URL => $url,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POST => true,
    //         CURLOPT_POSTFIELDS => $data,
    //         CURLOPT_HTTPHEADER => $headers,
    //     ];
    
    //     $curl = curl_init();
    //     curl_setopt_array($curl, $options);
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    
    //     return $response;
    // }
    
    // function deleteEvent($accessToken, $calendarId, $eventId) {
    //     $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events/{$eventId}";
    
    //     $headers = [
    //         "Authorization: Bearer {$accessToken}",
    //     ];
    
    //     $options = [
    //         CURLOPT_URL => $url,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_CUSTOMREQUEST => "DELETE",
    //         CURLOPT_HTTPHEADER => $headers,
    //     ];
    
    //     $curl = curl_init();
    //     curl_setopt_array($curl, $options);
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    
    //     return $response;
    // }

    // $accessToken = $_SESSION['access_token'];
    // $calendarId = "primary";

    // // Add event
    // $eventData = [
    //     "summary" => "Event Title",
    //     "location" => "Event Location",
    //     "description" => "Event Description",
    //     "start" => [
    //         "dateTime" => "2023-06-27T10:00:00",
    //         "timeZone" => "Asia/Jakarta",
    //     ],
    //     "end" => [
    //         "dateTime" => "2023-06-27T12:00:00",
    //         "timeZone" => "Asia/Jakarta",
    //     ],
    // ];

    // $response = addEvent($accessToken, $calendarId, $eventData);
    // echo $response;

    // Delete event
    // $eventId = "YOUR_EVENT_ID";
    // $response = deleteEvent($accessToken, $calendarId, $eventId);
    // echo $response;

    
    // fifth method // sudah mau //
    // require_once('../../distribusi/google-calendar-api.php');

    // // sudah mau //
    // // event id harus disimpan pada database untuk kebutuhan penghapusan
    // $accessToken = $_SESSION['access_token'];

    // // Set the necessary headers for the HTTP request
    // $headers = [
    //     'Content-Type: application/json',
    //     "Authorization: Bearer {$accessToken}",
    // ];

    // // Set the event details
    // $event = [
    //     'summary' => 'coba calendar delete 1',
    //     'start' => [
    //         "dateTime" => "2023-06-27T10:00:00",
    //         'timeZone' => 'Asia/Jakarta',
    //     ],
    //     'end' => [
    //         "dateTime" => "2023-06-27T12:00:00",
    //         'timeZone' => 'Asia/Jakarta',
    //     ],
    //     'location' => 'Jl. Nusa Dua, Benoa, Kec. Kuta Sel., Kabupaten Badung, Bali 80361, Indonesia',
    //     'description' => 'coba delete 1',
    // ];

    // // Convert the event details to JSON
    // $eventJson = json_encode($event);

    // // Set the URL for the API endpoint
    // $url = 'https://www.googleapis.com/calendar/v3/calendars/primary/events';

    // // Send the HTTP request to add the event
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $eventJson);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // curl_close($ch);

    // // Process the response
    // if ($response) {
    //     $responseData = json_decode($response, true);
    //     $eventId = $responseData['id'];
    //     echo "Event added successfully. Event ID: " . $eventId;
    // } else {
    //     echo "Failed to add event.";
    // }

    // contoh event id untuk code diatas
    // b9vf8e3b5ndsoigf2pchi968js //

    // sudah mau
    // Delete event
    // Set the necessary headers for the HTTP request
    // $headers = [
    //     "Authorization: Bearer {$accessToken}",
    // ];

    // // Set the event ID of the event to be deleted
    // $eventId = 'b9vf8e3b5ndsoigf2pchi968js';

    // // Set the URL for the API endpoint
    // $url = 'https://www.googleapis.com/calendar/v3/calendars/primary/events/' . $eventId;

    // // Send the HTTP request to delete the event
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // curl_close($ch);

    // // Process the response
    // if ($response) {
    //     echo "Event deleted successfully.";
    //     // echo $response;
    // } else {
    //     echo $response;
    //     echo "Failed to delete event.";
    // }






    // // trying to get list calendar //
    // require_once('../../distribusi/google-calendar-api.php');

    // $capi = new GoogleCalendarApi();

    // $calendar_list = $capi->GetCalendarsList($_SESSION['access_token']);
    // echo json_encode($calendar_list);
    


    // try get 1 data from table

    // $humanid = "-NYtRR9wwQKoHmLooXZm"; // Replace with the actual humanid

    // $humanRef = $database->getReference('Calendar_pembayaran')->getSnapshot();

    // $name = null;

    // foreach ($humanRef->getValue() as $key => $value) {
    //     if ($value['id_Detail_penjualan'] === $humanid) {
    //         $name = $value['google_calendar_id'];
    //         break;
    //     }
    // }

    // if ($name !== null) {
    //     echo $name;
    // } else {
    //     echo "No results found.";
    // }


    // $ref_table = 'Calendar_pembayaran';
    // $fetchdata = $database->getReference($ref_table)->getValue();

    // $arr = [];
    // $co = 0;
    // if($fetchdata > 0){
    //     $i = 0;
    //     foreach($fetchdata as $key => $row){
    //         $arr[$co] = array(
    //             'google_calendar_id' => $row['google_calendar_id'],
    //         );
    //         $co++;
    //     }
    // }

    // echo json_encode($arr);



    // $detailpengirimanid = "-NYu4rc3SxquJkaDXNx2";

    // // get google pembayaran id
    // $calendarpembayaranRef = $database->getReference('Calendar_pembayaran')->getSnapshot();

    // $googlepembayaranid = null;
    // $keypembayaran = null;

    // foreach ($calendarpembayaranRef->getValue() as $key => $value) {
    //     if ($value['id_Detail_penjualan'] == $detailpengirimanid) {
    //         $keypembayaran = $key;
    //         $googlepembayaranid = $value['google_calendar_id'];
    //         break;
    //     }
    // }

    // // // get google penjualan id
    // $calendarpenjualanRef = $database->getReference('Calendar_penjualan')->getSnapshot();

    // $googlepenjualanid = null;
    // $keypenjualan = null;

    // foreach ($calendarpenjualanRef->getValue() as $key => $value) {
    //     if ($value['id_Detail_penjualan'] == $detailpengirimanid) {
    //         $keypenjualan = $key;
    //         $googlepenjualanid = $value['google_calendar_id'];
    //         break;
    //     }
    // }

    // echo $googlepembayaranid;
    // echo "\n";
    // echo $keypembayaran;
    // echo "\n\n\n\n";
    // echo $googlepenjualanid;
    // echo "\n";
    // echo $keypenjualan;
    // echo "\n\n\n\n";
    // echo "\n\n\n\n";
    // echo "\n\n\n\n";
    // echo "\n\n\n\n";

    // $HpenjualanRef = $database->getReference('Hpenjualan')->getSnapshot();

    // $keyHpenjualan = null;

    // foreach ($HpenjualanRef->getValue() as $key => $value) {
    //     if ($value['id_Detail_penjualan'] === $detailpengirimanid) {
    //         $keyHpenjualan = $key;
    //         break;
    //     }
    // }

    // echo $keyHpenjualan;
    

    // coba delete
    // $database->getReference('tobe/'. "-NYFq-Couyc5qzs-qErX")->remove();

    // coba delete by child
    // $HpenjualanRef = $database->getReference('tobe')->getSnapshot();

    // $keyHpenjualan = null;

    // foreach ($HpenjualanRef->getValue() as $key => $value) {
    //     if ($value['foto_barang'] === "telur") {
    //         $keyHpenjualan = $key;
    //         break;
    //     }
    // }

    // $database->getReference('tobe/'. $keyHpenjualan)->remove();

    // get id pengingat and catatan
    // $ref_tablenota = 'Nota_penjualan/' . "-NWDmf25Y92CF4JJGyD6";
    // $fetchdatanota = $database->getReference($ref_tablenota)->getValue();

    // echo $fetchdatanota["id_Pengingat"];
    // echo "\n\n\n\n";
    // echo $fetchdatanota["id_Catatan"];



    $dates = array("2023-06-30T04:00:00", "2023-06-29T04:00:00", "2023-06-10T04:00:00");
    $latestDate = max($dates);

    echo $latestDate;
    
?>


<!-- calendar id coba hapus 2 -->
<!-- -NYonchB0SUhM_eyjbcy -->