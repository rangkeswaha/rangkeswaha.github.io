<!DOCTYPE html>
<html>
<?php 
session_start();
include "../import.php"; ?>
<link rel="stylesheet" href="../inventory/tambahbarang.css">

<script>
    // variable contain sessiont storage
    var keyhotel;

    $(document).on("click",".viewimage",function(){
        var selected = this;
        var id = this.id;

        var split = id.split("..");

        // alert(split[1]);

        // window.location.replace("/skripsi/apps" + split[1]);
        window.location.href = "/skripsi/apps" + split[1];

       
    });

    function pilih(key, nama, foto, alamat, deskripsi, detail_address, latitude, longitude){
        sessionStorage.setItem("diskey", key);
        sessionStorage.setItem("disnama", nama);
        sessionStorage.setItem("disfoto", foto);
        sessionStorage.setItem("disalamat", alamat);
        sessionStorage.setItem("disdeskripsi", deskripsi);
        sessionStorage.setItem("disdetailaddress", detail_address);
        sessionStorage.setItem("dislatitude", latitude);
        sessionStorage.setItem("dislongitude", longitude);

        window.location.href = "detailtempat.php";
    }

    function gettpesanan() {
        $.ajax({
            url:"../ajax/laporanstok/gethoteltpesanan.php",
            type:"post",
            data: { keyhotel:keyhotel,},
            success: function(response) {
                // console.log(res);
                
                // alert(res);
                var datahotel = JSON.parse(response);

                // alert("Data Tempat Telah Diganti");
                // alert(datahotel);
                
                // document.getElementById("tPesanan").innerHTML = datahotel[0];
                // document.getElementById("tPembayaran").innerHTML = "Rp " + datahotel[1];
                document.getElementById("tPesanan").innerHTML = parseFloat(datahotel[0]).toLocaleString('en');
                document.getElementById("tPembayaran").innerHTML = "Rp " + parseFloat(datahotel[1]).toLocaleString('en');


                // modal = document.getElementById("myModal");
                // modal.style.display = "none";

                // $('#example').DataTable().ajax.reload();
                // window.location.replace("profile.php");
            },
            error:function(err){
                alert(err);
                alert("err");
            }
        });
    }

    function gettberat() {
        $.ajax({
            url:"../ajax/laporanstok/gethoteltberat.php",
            type:"post",
            data: { keyhotel:keyhotel,},
            success: function(response) {
                // console.log(res);
                
                // alert(res);
                var datahotel = JSON.parse(response);

                // alert("Data Tempat Telah Diganti");
                // alert(datahotel);
                
                // document.getElementById("tBeratPesanan").innerHTML = datahotel + " kg";
                document.getElementById("tBeratPesanan").innerHTML = parseFloat(datahotel).toLocaleString('en') + " kg";

                // modal = document.getElementById("myModal");
                // modal.style.display = "none";

                // $('#example').DataTable().ajax.reload();
                // window.location.replace("profile.php");
            },
            error:function(err){
                alert(err);
                alert("err");
            }
        });
    }

    function refreshTablepenjualan(){
        $('#example').DataTable( {
            responsive: true,
            "ajax": {
                "url": "../ajax/laporanstok/getdatapenjualanhotel.php",
                "type": "POST",
                "data": {
                    keyhotel: keyhotel,
                },
                "error": function(xhr, error, thrown) {
                    console.error(error);
                },
                "dataSrc": function(response) {
                    if (response.error) {
                        // console.error(response.error);
                        return [];
                    } else {
                        return response;
                    }
                }
            },
            "columns": [
                // { "data": "nama_pembeli" },
                { "data": "status_penjualan" },
                // { "data": "jumlah_barang" },
                {
                    "data": "jumlah_barang",
                    "render": function (data, type, row) {
                        return parseFloat(data).toLocaleString('en');
                    }
                },
                // { "data": "total_berat" },
                {
                    "data": "total_berat",
                    "render": function (data, type, row) {
                        return parseFloat(data).toLocaleString('en');
                    }
                },
                // { "data": "total_harga" },
                {
                    "data": "total_harga",
                    "render": function (data, type, row) {
                        return parseFloat(data).toLocaleString('en');
                    }
                },
                { "data": "tanggal_bayar" },
                { "data": "tanggaldijual" },
            ]
        });
    }

    $(document).ready(function(){
        // get session storage data
        keyhotel = sessionStorage.getItem('diskey');
        // alert(keyhotel);


        // gettempat();
        gettpesanan();
        gettberat();
        refreshTablepenjualan();
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});

        var imagehotel = document.getElementById("coverimage");
        imagehotel.setAttribute("src", "/skripsi/apps/ajax/tempatdistribusi/"+sessionStorage.getItem('disfoto')+"");


        // var value = sessionStorage.getItem('disnama');
        // alert(value);

        document.getElementById("hotelName").innerHTML = sessionStorage.getItem('disnama');
        document.getElementById("hotelLocation").innerHTML = sessionStorage.getItem('disalamat');
        document.getElementById("hotelDescription").innerHTML = sessionStorage.getItem('disdeskripsi');
        // document.getElementById('address-detail').value = sessionStorage.getItem('detailpengirimandetailaddress');

        
        
    });
</script>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="">
    <!-- begin header -->
    <?php include "../header.php"; ?>
    <!-- end header -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row">
      <!-- begin sidebar -->
      <?php include "../sidebar.php"; ?>
      <!-- end sidebar -->
      <!-- BEGIN PAGE CONTAINER-->
      <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div id="portlet-config" class="modal hide">
          <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>Widget Settings</h3>
          </div>
          <div class="modal-body"> Widget settings form goes here </div>
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <ul class="breadcrumb">
                <li>
                    <p>YOU ARE HERE</p>
                </li>
                <li><a href="/skripsi/apps/profiletempat/listtempat.php" class="#">List Tempat</a> </li>
                <li><a href="/skripsi/apps/profiletempat/detailtempat.php" class="active">Laporan Tempat</a> </li>
            </ul>
            <div class="page-title">
                <h3>Profile - <span class="semi-bold">Laporan Tempat</span></h3>
            </div>
            <div class="grid simple form-grid">
                <div class="card">
                    <center>
                        <img id="coverimage" src="/skripsi/apps/ajax/inventory/uploads/9167Original Background.jpg" alt="Avatar" style="object-position: inherit; border-top-left-radius: 15px; border-top-right-radius: 15px; position: relative; object-fit: cover; width: 100%; height: 300px; background-repeat: no-repeat; ">
                        <!-- <h2 style="color: Black;"><b>Hotel Ayodya</b></h2>  -->
                        <h1 style="color: Black; margin-bottom: -2%;" id="hotelName"><b></b></h1> 
                    </center>
                    <div class="container" style="margin-left: 3%;">
                        <!-- <p class="iconlocation">Nusa Dua</p> -->
                        <h4 class="iconlocation" id="hotelLocation">Nusa Dua</h4>
                        <!-- <h4>Hotel dengan pemandangan di pantai</h4> -->
                        <h3 id="hotelDescription"></h3>
                    </div>

                    <div class="grid-body no-border" style="border-radius: 10px;">
                        <br>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <center>
                                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 0%; margin-top: 1%;">Total Pesanan</label>
                                        </center>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 0%; margin-top: 1%;">Total Berat Pesanan</label>
                                        </center>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 0%; margin-top: 1%;">Total Pembayaran</label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <center>
                                        <label id="tPesanan" class="form-label" style="font-size:15px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;"></label>
                                        </center>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <label id="tBeratPesanan" class="form-label" style="font-size:15px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;"></label>
                                        </center>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                        <label id="tPembayaran" class="form-label" style="font-size:15px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;"></label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>
                        <form id="formDaftarTempat">
                            <!-- table list Notifikasi -->
                            <center>
                                <h3><span class="semi-bold">Seluruh Penjualan</span></h3>
                            </center>
                            <!-- <p>Type something in the input field to search the table value</p>  
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">   -->
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Total Barang</th>
                                        <th>Total Berat (kg)</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Tanggal Pembayaran</th>
                                        <!-- <th>Detail</th>
                                        <th>Nota</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>

                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
          <!-- END PAGE -->
        </div>
      </div>
      <!-- END CONTAINER -->
    </div>
 
  </body>
</html>


<script>

    $('#Plainorder').click(function(){
      window.location.href = "tempatpesananmanual.php";
    });

    // $(document).on("change",".cobachange",function(){
    //     var deskripsi = $("#cobachange").val();

    //     if(deskripsi == "a"){
    //         document.getElementById("hasilchange").value = 'jadi A';
    //     }else{
    //         document.getElementById("hasilchange").value = 'keganti';
    //     }
    // });

    // document.getElementById('cobachange').onchange = function() {
    //     var deskripsi = $("#cobachange").val();

    //     if(deskripsi == "a"){
    //         document.getElementById("hasilchange").value = 'jadi A';
    //     }else{
    //         document.getElementById("hasilchange").value = 'keganti';
    //     }
    // };

    // $('#cobachange').change(function() {
    //     var deskripsi = $("#cobachange").val();

    //     if(deskripsi == "a"){
    //         document.getElementById("hasilchange").value = 'jadi A';
    //     }else{
    //         document.getElementById("hasilchange").value = 'keganti';
    //     }
    // });

    // // or

    // document.getElementById('cobachange').addEventListener(
    //     'change',
    //     callbackFunction,
    //     false
    // );


    $('#saveTempat').click(function(){
        var nama = $("#namePlace").val();
        var alamat = $("#addressPlace").val();
        var deskripsi = $("#deskripsiTempat").val();
        var foto = $("#fotoTempat")[0].files;
    

        var form_data = new FormData();
        form_data.append("nama", nama);
        form_data.append("alamat", alamat);
        form_data.append("deskripsi", deskripsi);
        form_data.append("namafoto", foto[0]);

        $.ajax({
            url:"../ajax/tempatdistribusi/addtempatdis.php",
            type:"post",
            data:form_data,
            contentType: false,
            processData: false,
            success:function(res){
                // console.log(res);
                
                // alert(res);

                alert("Data Tempat Telah Disimpan");

                $('#example').DataTable().ajax.reload();
                // window.location.replace("profile.php");
            },
            error:function(err){
                alert(err);
                alert("err");
            }
        });
    });

    $('#editTempat').click(function(){
        var nama = $("#namePlaceModal").val();
        var alamat = $("#addressPlaceModal").val();
        var deskripsi = $("#deskripsiTempatModal").val();
        var foto = $("#uploadImageModal")[0].files;
        var oldfoto = sessionStorage.getItem("oldimage");
        var key = sessionStorage.getItem("key");

        // alert(oldfoto);

        // alert(foto.length);

        if(foto.length != 0){
            var form_data = new FormData();
            form_data.append("nama", nama);
            form_data.append("alamat", alamat);
            form_data.append("deskripsi", deskripsi);
            form_data.append("foto", foto[0]);
            form_data.append("oldfoto", oldfoto);
            form_data.append("cek", "yes");
            form_data.append("key", key);

            $.ajax({
                url:"../ajax/tempatdistribusi/edittempatdis.php",
                type:"post",
                data:form_data,
                contentType: false,
                processData: false,
                success:function(res){
                    // console.log(res);
                    
                    // alert(res);

                    alert("Data Tempat Telah Diganti");

                    modal = document.getElementById("myModal");
                    modal.style.display = "none";

                    $('#example').DataTable().ajax.reload();
                    // window.location.replace("profile.php");
                },
                error:function(err){
                    alert(err);
                    alert("err");
                }
            });
        }else{
            var form_data = new FormData();
            form_data.append("nama", nama);
            form_data.append("alamat", alamat);
            form_data.append("deskripsi", deskripsi);
            form_data.append("foto", foto[0]);
            form_data.append("oldfoto", oldfoto);
            form_data.append("cek", "no");
            form_data.append("key", key);

            $.ajax({
                url:"../ajax/tempatdistribusi/edittempatdis.php",
                type:"post",
                data:form_data,
                contentType: false,
                processData: false,
                success:function(res){
                    // console.log(res);
                    
                    // alert(res);

                    alert("Data Tempat Telah Diganti");

                    modal = document.getElementById("myModal");
                    modal.style.display = "none";

                    $('#example').DataTable().ajax.reload();
                    // window.location.replace("profile.php");
                },
                error:function(err){
                    alert(err);
                    alert("err");
                }
            });
        }

    });


    (function($) {
    $.fn.currencyInput = function() {
            this.each(function() {
                var wrapper = $("<div class='currency-input' />");
                $(this).wrap(wrapper);
                $(this).before("<span class='currency-symbol'>Rp</span>");
                $(this).change(function() {
                    var min = parseFloat($(this).attr("min"));
                    var max = parseFloat($(this).attr("max"));
                    var value = this.valueAsNumber;
                    if(value < min)
                        value = min;
                    else if(value > max)
                        value = max;
                    $(this).val(value.toFixed(0)); 
                });
            });
        };
    })(jQuery);

    $(document).ready(function() {
        $('input.currency').currencyInput();
    });
</script>

<style>
  .card {
    box-shadow: 0 7px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 100%;
    border-radius: 15px;
    margin-top: 25px;
    /* cursor: pointer; */
  }

  /* .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  } */

  .container {
    padding: 2px 16px;
  }

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  margin-left: 25%;
  padding: 20px;
  border: 1px solid #888;
  width: 53%;
}

/* The Close Button */
.closeModal {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  margin-top: -1.2%;
  font-weight: bold;
}

.closeModal:hover,
.closeModal:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.iconlocation {
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 512'%3E%3C!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --%3E%3Cpath d='M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z'/%3E%3C/svg%3E") 0 2px / 14px 14px no-repeat;
  width: 180px;
  padding-left: 20px;
}

</style>