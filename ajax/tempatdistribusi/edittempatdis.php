<?php
    session_start();
    include('../../db.php');

    // echo 'diluar first';

    // echo 'didalem first';
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $deskripsi = $_POST["deskripsi"];
    $foto = $_FILES["foto"];
    $oldfoto = $_POST["oldfoto"];
    $cek = $_POST["cek"];
    $key = $_POST["key"];

    // echo $oldfoto;
    // echo $fotobarang;
    // echo $key;
    // echo $_POST['formdeskripsi'];
    // echo htmlentities($_POST['formdeskripsi']);;

    if ($cek == "yes"){

        $uid = $key;

        $target_dir = "uploads/";
        $target_file = $target_dir . round(microtime(true)) . '.' . basename($_FILES["foto"]["name"]);
        $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        }

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }


        // $postData = [
        //     'nama_pembeli' => $nama,
        //     'alamat_pembeli' => $alamat,
        //     'deskripsi_pembeli' => $deskripsi,
        //     'foto_pembeli' => $target_file,
        // ];

        // // Create a key for a new post
        // $newPostKey = $database->getReference('distribusi')->push()->getKey();

        // $updates = [
        //     'distribusi/'.$uid => $postData,
        //     // 'mkategori/'.$uid.'/'.$newPostKey => $postData,
        // ];

        // $database->getReference() // this is the root reference
        //     ->update($updates);
        // echo ("Tempat Berhasil Diganti");

        // move_uploaded_file($_FILES['fotobarang']['tmp_name'], "uploads/". $new_image);

        // header("Location: ../../inventory/stokbarang.php");

        $updatedata = [
            'nama_pembeli' => $nama,
            'alamat_pembeli' => $alamat,
            'deskripsi_pembeli' => $deskripsi,
            'foto_pembeli' => $target_file,
        ];
    
        $reftable = 'distribusi/' . $uid;
        $database->getReference($reftable)->update($updatedata);

    }else{
        $uid = $key;

        // $postData = [
        //     'nama_pembeli' => $nama,
        //     'alamat_pembeli' => $alamat,
        //     'deskripsi_pembeli' => $deskripsi,
        //     'foto_pembeli' => $oldfoto,
        // ];

        // // Create a key for a new post
        // $newPostKey = $database->getReference('distribusi')->push()->getKey();

        // $updates = [
        //     'distribusi/'.$uid => $postData,
        //     // 'mkategori/'.$uid.'/'.$newPostKey => $postData,
        // ];

        // $database->getReference() // this is the root reference
        //     ->update($updates);
        // echo ("Tempat Berhasil Diganti");

        // header("Location: ../../inventory/stokbarang.php");

        $updatedata = [
            'nama_pembeli' => $nama,
            'alamat_pembeli' => $alamat,
            'deskripsi_pembeli' => $deskripsi,
            'foto_pembeli' => $oldfoto,
        ];
    
        $reftable = 'distribusi/' . $uid;
        $database->getReference($reftable)->update($updatedata);

    }


    // if(isset($_POST['deleteBarang'])){

    //     //berikan alert jika ingin menghapus atau tidak disini

    //     $keyawal = $_POST["keyBarang"];

    //     $database->getReference('inventory/'. $keyawal)->remove();

    //     header("Location: ../../inventory/stokbarang.php");
    // }


?>