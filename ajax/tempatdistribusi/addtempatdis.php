<?php
    session_start();
    include('../../db.php');

    // echo 'diluar first';

    // $namafoto = $_FILES["fotoTempat"];
    // $random_no = rand(1111,9999);

    // $new_image = $random_no.$namafoto;

    // $filename = 'uploads/' .$new_image;
    // echo $new_image;

    // move_uploaded_file($_FILES['fotoTempat']['tmp_name'], "uploads/". $new_image);

    // echo $new_image;


    // if(isset($_POST['savebarangbutton'])){

        // echo 'didalem first';
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $deskripsi = $_POST["deskripsi"];
        // $namafoto = $_POST["namafoto"];
        $filefoto = $_FILES["namafoto"];
        $savelatitude = $_POST["savelatitude"];
        $savelongitude = $_POST["savelongitude"];
        $savedetail_address = $_POST["savedetail_address"];

        // echo $filefoto;

        $target_dir = "uploads/";
        $target_file = $target_dir . round(microtime(true)) . '.' . basename($_FILES["namafoto"]["name"]);
        $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        }

        if (move_uploaded_file($_FILES["namafoto"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["namafoto"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        // $random_no = rand(1111,9999);

        // $new_image = $random_no.$namafoto;
    
        // $filename = 'uploads/' .$new_image;

        // // echo $_POST['formdeskripsi'];

        // // echo htmlentities($_POST['formdeskripsi']);;
        

        $properties = [
            'nama_pembeli' => $nama,
            'alamat_pembeli' => $alamat,
            'deskripsi_pembeli' => $deskripsi,
            'foto_pembeli' => $target_file,
            'savelatitude' => $savelatitude,
            'savelongitude' => $savelongitude,
            'savedetail_address' => $savedetail_address,
        ];

        $ref_table = "distribusi";
        $postRef_result = $database->getReference($ref_table)->push($properties);

        // move_uploaded_file($_FILES['namafoto']['tmp_name'], "uploads/". $new_image);

        // // echo 'didalem last';

        // // header("Location: ../../inventory/stokbarang.php");

    // }

    // echo 'diluar last';

?>