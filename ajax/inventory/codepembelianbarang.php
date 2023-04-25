<?php 
    session_start();
    include('../../db.php');

    // echo 'diluar first';

    if(isset($_POST['editBarang'])){

        // echo 'didalem first';
        $namegoods = $_POST["namegoods"];
        $pricegoods = $_POST["pricegoods"];
        $stockgoods = $_POST["stockgoods"];
        $kategoribarang = $_POST["selectKategori"];
        $splitkategori = explode("_", $kategoribarang);
        $kategori = $splitkategori[0];
        $formdeskripsi = htmlentities($_POST['formdeskripsi']);
        $fotobarang = $_FILES["fotobarang"]['name'];
        $oldfoto = $_POST["oldImage"];
        $keyawal = $_POST["keyBarang"];
        // echo $oldfoto;
        // echo $fotobarang;
        // echo $key;
        // echo $_POST['formdeskripsi'];
        // echo htmlentities($_POST['formdeskripsi']);;

        if ($fotobarang != NULL){

            $uid = $keyawal;

            $random_no = rand(1111,9999);

            $new_image = $random_no.$fotobarang;

            $filename = 'uploads/' .$new_image;


            $postData = [
                'nama_barang' => $namegoods,
                'harga_barang' => $pricegoods,
                'stok_barang' => $stockgoods,
                'kategori_barang' => $kategori,
                'deskripsi_barang' => htmlentities($_POST['formdeskripsi']),
                'foto_barang' => $filename,
            ];

            // Create a key for a new post
            $newPostKey = $database->getReference('inventory')->push()->getKey();

            $updates = [
                'inventory/'.$uid => $postData,
                // 'mkategori/'.$uid.'/'.$newPostKey => $postData,
            ];

            $database->getReference() // this is the root reference
                ->update($updates);
            echo ("Barang Berhasil Diganti");

            move_uploaded_file($_FILES['fotobarang']['tmp_name'], "uploads/". $new_image);

            header("Location: ../../inventory/stokbarang.php");

        }else{
            $uid = $keyawal;

            $postData = [
                'nama_barang' => $namegoods,
                'harga_barang' => $pricegoods,
                'stok_barang' => $stockgoods,
                'kategori_barang' => $kategori,
                'deskripsi_barang' => htmlentities($_POST['formdeskripsi']),
                'foto_barang' => $oldfoto,
            ];

            // Create a key for a new post
            $newPostKey = $database->getReference('inventory')->push()->getKey();

            $updates = [
                'inventory/'.$uid => $postData,
                // 'mkategori/'.$uid.'/'.$newPostKey => $postData,
            ];

            $database->getReference() // this is the root reference
                ->update($updates);
            echo ("Barang Berhasil Diganti");

            header("Location: ../../inventory/stokbarang.php");

        }

    }

?>