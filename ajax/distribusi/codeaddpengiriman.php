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
    $propertiesnota = [
        'id_Pengingat' => $newidnote,
        'id_Catatan' => $newidpengingat,
        'nama_pembeli' => $disnama,
        'list_barang' => $dataorder,
    ];
    
    $ref_table3 = "Nota_penjualan";
    $postRef_result3 = $database->getReference($ref_table3)->push($propertiesnota);

    $newidnota = $postRef_result3->getKey();
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