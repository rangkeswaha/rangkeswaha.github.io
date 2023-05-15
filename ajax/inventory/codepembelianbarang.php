<?php 
    session_start();
    include('../../db.php');

    // echo 'diluar first';

    // if(isset($_POST['editBarang'])){

        // echo 'didalem first';
        // $namegoods = $_POST["namegoods"];
        // $buylengthgoods = $_POST["buylengthgoods"];
        // $stockgoods = $_POST["stockgoods"];
        // $buydategoods = $_POST["buydategoods"];
        $allnewdata = $_POST["allnewdata"];
        $data = json_decode($allnewdata, true);
       
        // $data = [
        //     [
        //         'name' => 'morty',
        //         'age' => 15
        //     ],
        //     [
        //         'name' => 'rick',
        //         'age' => 70
        //     ]
        // ];
        // echo $allnewstock[0]['key'];
        // echo $fotobarang;
        // echo $key;
        // echo $_POST['formdeskripsi'];
        // echo htmlentities($_POST['formdeskripsi']);;

        // for($i = 0; $i < count($data); $i++){
        //     $properties = [
        //         'lama_pembelian' => $data[$i]['name'],
        //         'tanggal_pembelian' => $data[$i]['age'],
        //         // 'jumlah_barang' => $array[$i]['stockgoods'],
        //     ];
    
        //     $ref_table = "Pembelian_stok";
        //     $postRef_result = $database->getReference($ref_table)->push($properties);
        // }
        // echo json_encode($data[0]['buydategoods']);
        $allnewkeys = array();

        for($i = 0; $i < count((array)$data); $i++){
            $totalstock = 0;
            
            $properties = [
                'lama_pembelian' => $data[$i]['buylengthgoods'],
                'tanggal_pembelian' => $data[$i]['buydategoods'],
                'jumlah_barang' => $data[$i]['stockgoods'],
            ];
    
            $ref_table = "Pembelian_stok";
            $postRef_result = $database->getReference($ref_table)->push($properties);

            $pembelianstoknewid = $postRef_result->getKey();
            // echo 'New data ID: ' . $pembelianstoknewid;

            // Total stok (stok baru)
            $totalstock = $data[$i]['firststockgoods'] + $data[$i]['stockgoods'];

            // ID barang
            $uid = $data[$i]['key'];

            $properties_history = [
                'id_Barang' => $uid,
                'id_Pembelian_Stok' => $pembelianstoknewid,
                'stok_sebelumnya' => $data[$i]['firststockgoods'],
                'stok_baru' => $totalstock,
            ];

            $ref_table_history = "Hpembelian_stok";
            $postRef_result_history = $database->getReference($ref_table_history)->push($properties_history);

            // $newPostKey = $newPostRef->getKey();
            // array_push($allnewkeys, array(
            //     'key_pembelian' => $newPostRef->getKey(),
            //     'key_barang' => $data[$i]['key'],
            // ));

            $ref = $database->getReference('inventory');

            $ref->getChild($uid)->update(['stok_barang' => $totalstock]);


            $totalstock = 0;
            // $postData = [
            //     'stok_barang' => $stockgoods,
            // ];

            // $newPostKey = $database->getReference('inventory')->push()->getKey();

            // $updates = [
            //     'inventory/'.$uid => $postData,
            // ];

            // $database->getReference() // this is the root reference
            //     ->update($updates);
        }

        // if ($fotobarang != NULL){

        //     $uid = $keyawal;

        //     $random_no = rand(1111,9999);

        //     $new_image = $random_no.$fotobarang;

        //     $filename = 'uploads/' .$new_image;


        //     $postData = [
        //         'nama_barang' => $namegoods,
        //         'harga_barang' => $pricegoods,
        //         'stok_barang' => $stockgoods,
        //         'kategori_barang' => $kategori,
        //         'deskripsi_barang' => htmlentities($_POST['formdeskripsi']),
        //         'foto_barang' => $filename,
        //     ];

        //     // Create a key for a new post
        //     $newPostKey = $database->getReference('inventory')->push()->getKey();

        //     $updates = [
        //         'inventory/'.$uid => $postData,
        //         // 'mkategori/'.$uid.'/'.$newPostKey => $postData,
        //     ];

        //     $database->getReference() // this is the root reference
        //         ->update($updates);
        //     echo ("Barang Berhasil Diganti");

        //     move_uploaded_file($_FILES['fotobarang']['tmp_name'], "uploads/". $new_image);

        //     header("Location: ../../inventory/stokbarang.php");

        // }else{
        //     $uid = $keyawal;

        //     $postData = [
        //         'nama_barang' => $namegoods,
        //         'harga_barang' => $pricegoods,
        //         'stok_barang' => $stockgoods,
        //         'kategori_barang' => $kategori,
        //         'deskripsi_barang' => htmlentities($_POST['formdeskripsi']),
        //         'foto_barang' => $oldfoto,
        //     ];

        //     // Create a key for a new post
        //     $newPostKey = $database->getReference('inventory')->push()->getKey();

        //     $updates = [
        //         'inventory/'.$uid => $postData,
        //         // 'mkategori/'.$uid.'/'.$newPostKey => $postData,
        //     ];

        //     $database->getReference() // this is the root reference
        //         ->update($updates);
        //     echo ("Barang Berhasil Diganti");

        //     header("Location: ../../inventory/stokbarang.php");

        // }

    // }

?>