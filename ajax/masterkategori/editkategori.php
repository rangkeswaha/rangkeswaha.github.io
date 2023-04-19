<?php
    include('../../db.php');
     
    $formeditkategori = $_POST["formeditkategori"];
    $kategoriawal = $_POST["kategoriawal"];
    $keyawal = $_POST["keyawal"];

    $ref_table = 'mkategori';
    $fetchdata = $database->getReference($ref_table)->getValue();

    $arr = [];
    if($fetchdata > 0){
        $i = 0;
        foreach($fetchdata as $key => $row){
            array_push($arr, $row);
        }
    }


    $checkvalue = 0;
    foreach($arr as $key => $row){
        if (strtolower($row['kategori']) == strtolower($formeditkategori)){
            $checkvalue = 1;
            break;
        }
        // echo ($row['kategori']);
    }

    // $formeditkategori = 'Ikan';
    // $kategoriawal = 'Ikan';
    // $keyawal = '-N0qonXNv9IllTurAdHA';


    if($checkvalue == 0){
        $uid = $keyawal;
        $postData = [
            'kategori' => $formeditkategori,
        ];

        // Create a key for a new post
        $newPostKey = $database->getReference('mkategori')->push()->getKey();

        $updates = [
            'mkategori/'.$uid => $postData,
            // 'mkategori/'.$uid.'/'.$newPostKey => $postData,
        ];

        $database->getReference() // this is the root reference
            ->update($updates);
        echo ("Kategori Berhasil Diganti");    
    }else{
        echo ("Kategori Sudah Ada");
    }

?>
