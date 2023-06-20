<!DOCTYPE html>
<html>
<?php 
session_start();
include "../import.php"; ?>
<link rel="stylesheet" href="../inventory/tambahbarang.css">

<style>
    #map {
        height: 500px;
        width: 100%;
    }
    #mapModal {
        height: 400px;
        width: 100%;
    }
    #gambartooltip {
        width:100%;
        height:100%;
    }
    .tooltip-inner {
        width: 150px;
        height: 120px;
        /* padding-left: 40%; */
    }
    td.details-control {
        background: url('https://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('https://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
/* 
    #pegawaiData tr:nth-child(even){background-color: black;}
    #pegawaiData tr:nth-child(odd){background-color: black;} */
</style>

<script>
    var keynota;
    var keydetailpenjualan;

    function getnota() {
        $.ajax({
            type: 'POST',
            url: '../ajax/distribusi/getnotapenjualan.php',
            data: { keynota:keynota,},
            success: function(response) {
                var data = JSON.parse(response);
                allbarang = data;
                // alert(allbarang[0].nama_barang);
                // var firstObject = response.list_barang[0];
                // alert(firstObject);

                var descriptionvalue = "Barang - barang yang dikirim: \n";
                for (var i = 0; i < allbarang.length; i++){
                    // alert(allneworder[i].namegoods);
                    var number = i + 1;
                    descriptionvalue += number.toString() + " " + allbarang[i].nama_barang + " " + allbarang[i].stok_dijual.toString() + "kg" + "\n";
                }
                // alert(descriptionvalue);

                document.getElementById('listBarang').value = descriptionvalue;

               
            },
            error: function(a, err){
                //lakukan sesuatu untuk handle error
                // alert("Data Gagal Disimpan");
                alert("Error: " + err);
                // alert(err.responseJSON.message);
            },
        });
    }

    $(document).ready(function(){
        // get detail data from session storage
        keynota = sessionStorage.getItem('detailpengirimanidnota');
        // alert(keynota);
        keydetailpenjualan = sessionStorage.getItem('detailpengirimankey');
        // alert(keydetailpenjualan);
        var detaillatitude = sessionStorage.getItem('detailpengirimanlatitude');
        var detaillatitude = parseFloat(detaillatitude);
        var detaillongitude = sessionStorage.getItem('detailpengirimanlongitude');
        var detaillongitude = parseFloat(detaillongitude);
        // alert(typeof detaillatitude);
        // alert(detaillongitude);
        document.getElementById('address-detail').value = sessionStorage.getItem('detailpengirimandetailaddress');
        document.getElementById('namePlace').value = sessionStorage.getItem('detailpengirimannamapembeli');
        document.getElementById('statusPesanan').value = sessionStorage.getItem('detailpengirimanstatuspenjualan');
        document.getElementById('datePengiriman').value = sessionStorage.getItem('detailpengirimantanggalpengiriman');
        document.getElementById('datePembayaran').value = sessionStorage.getItem('detailpengirimantanggalpembayaran');
        document.getElementById('jumlahBarang').value = sessionStorage.getItem('detailpengirimanjumlahbarang');
        document.getElementById('totalHarga').value = sessionStorage.getItem('detailpengirimantotalharga');

        getnota();

        var statuscheck = sessionStorage.getItem('detailpengirimanstatuspenjualan');

        if(statuscheck == "Proses Pengiriman"){
            // Get the button element by its ID
            var myButton = document.getElementById("ubahStatus");

            // Change the name of the button
            myButton.innerHTML = "Pengiriman Selesai";
        }else{
            // Get the button element by its ID
            var myButton = document.getElementById("ubahStatus");

            // Change the name of the button
            myButton.innerHTML = "Pembayaran Telah Diterima";

        }

        // var listbarang = "Barang - barang yang dikirim: \n";
        // for (var i = 0; i < allneworder.length; i++){
        //     // alert(allneworder[i].namegoods);
        //     var number = i + 1;
        //     descriptionvalue += number.toString() + " " + allneworder[i].namegoods + " " + allneworder[i].stockgoods.toString() + "kg" + "\n";
        // }
        // if (content != ""){
        //     descriptionvalue += "\nCatatan Pengiriman\n" + content;

        // }
        // // alert(descriptionvalue);
        // document.getElementById('listBarang').value = sessionStorage.getItem('detailpengirimandetailaddress');
        
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
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
                <li><a href="/skripsi/apps/distribusi/daftarpesanan.php" class="#">List Pesanan</a> </li>
                <li><a href="/skripsi/apps/distribusi/detailpesanan.php" class="active">Detail Pesanan</a> </li>
            </ul>
            <div class="page-title">
                <h3>List Pesanan - <span class="semi-bold">Detail Pesanan</span></h3>
            </div>
            <div class="grid simple form-grid">
                <div class="grid-body no-border" style="border-radius: 10px;">
                    <br>
                    <form id="formDaftarTempat">
                        <div class="form-group">
                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;">Data Tempat</label>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <label>Nama Tempat</label>
                                    <input name="namePlace" id="namePlace" type="text"
                                        class="form-control" placeholder="Hotel Ayana" disabled value="">
                                </div>
                                <div class="col-md-6">
                                    <label>Status Pesanan</label>
                                    <input name="statusPesanan" id="statusPesanan" type="text"
                                        class="form-control" placeholder="Hotel Ayana" disabled value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <label>Tanggal dan Waktu Pengiriman</label>
                                    <input name="datePengiriman" id="datePengiriman" type="text"
                                        class="form-control" placeholder="Hotel Ayana" disabled value="">
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Pembayaran</label>
                                    <input name="datePembayaran" id="datePembayaran" type="text"
                                        class="form-control" placeholder="Hotel Ayana" disabled value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <label>Jumlah Barang</label>
                                    <input name="jumlahBarang" id="jumlahBarang" type="text"
                                        class="form-control" placeholder="Hotel Ayana" disabled value="">
                                </div>
                                <div class="col-md-6">
                                    <label>Total Harga</label>
                                    <input name="totalHarga" id="totalHarga" type="text"
                                        class="form-control" placeholder="Hotel Ayana" disabled value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <label class="form-label">List Barang</label>
                                    <br>
                                    <textarea rows="4" style="width: 100%; height: 150px;" id="listBarang" name="listBarang" disabled placeholder="Tulis Disini......."></textarea>
                                    <!-- <textarea name="formdeskripsi" id="" cols="30" rows="10"></textarea> -->
                                    <!-- <input name="formdeskripsi" id="formdeskripsi" type="textarea"class="form-control" placeholder="Tulis Disini......." value=""> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <label class="form-label">Detail Alamat</label>
                                    <br>
                                    <input name="address-detail" id="address-detail" disabled type="text"
                                        class="form-control" placeholder="Hotel Ayana" value="">
                                    <!-- <input type="text" id="address-detail"> -->
                                    <div id="map"></div>
                                    <!-- Load the Google Maps JavaScript API asynchronously -->
                                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw&callback=initMap"></script>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="pull-right">
                                <button type="button" id="ubahStatus" name="ubahStatus" style="background-color: #53a551; color: white;" class="btn btn-cons"><i class="icon-ok"></i>
                                </button>
                            </div>
                        </div>
                    </form>
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
    var savelongitude;
    var savelatitude;
    var savedetail_address;

    $('#ubahStatus').click(function(){

        var statuscheck = sessionStorage.getItem('detailpengirimanstatuspenjualan');

        var text;

        if(statuscheck == "Proses Pengiriman"){
            var text = "Menunggu Pembayaran";
        }else{
            var text = "Pembayaran Diterima";
        }

        $.ajax({
            url:"../ajax/distribusi/updatestatuspengiriman.php",
            type:"post",
            data: { status: text,
                    key: keydetailpenjualan},
            success:function(res){
                // console.log(res);
                
                // alert(res);
                if(statuscheck == "Proses Pengiriman"){
                    alert("Pengiriman Berhasil");
                }else{
                    alert("Pembayaran Diterima");
                }
                window.location.href = "daftarpesanan.php";

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
</style>

<!-- Google API -->
<!-- AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw -->

<!-- Script for the map on page -->
<script>
    // setInterval(initMap, 1000);
    function initMap() {
        // Get user location
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // Create map centered on user location
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: userLocation
            });

            // Create marker for user location
            var userMarker = new google.maps.Marker({
                position: userLocation,
                map: map,
                title: 'Your Location'
            });

            var detaillatitude = sessionStorage.getItem('detailpengirimanlatitude');
            var detaillatitude = parseFloat(detaillatitude);
            var detaillongitude = sessionStorage.getItem('detailpengirimanlongitude');
            var detaillongitude = parseFloat(detaillongitude);

            // Create marker for goal location
            var goalLocation = {lat: detaillatitude, lng: detaillongitude};
            var goalMarker = new google.maps.Marker({
                position: goalLocation,
                map: map,
                title: 'Goal Location'
            });

            // Create circle around goal location
            var goalCircle = new google.maps.Circle({
                strokeColor: '#0000FF',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#0000FF',
                fillOpacity:0.35,
                map: map,
                center: goalLocation,
                radius: 100 // in meters
            });

            // Check if user is within circle
            google.maps.event.addListener(map, 'idle', function() {
                var distance = google.maps.geometry.spherical.computeDistanceBetween(userMarker.getPosition(), goalCircle.getCenter());
                if (distance <= goalCircle.getRadius()) {
                    // alert('You Have Arrived');
                    
                    var statuscheck = sessionStorage.getItem('detailpengirimanstatuspenjualan');

                    var text;

                    if(statuscheck == "Proses Pengiriman"){
                        var text = "Menunggu Pembayaran";
                    }else{
                        var text = "Pembayaran Diterima";
                    }

                    $.ajax({
                        url:"../ajax/distribusi/updatestatuspengiriman.php",
                        type:"post",
                        data: { status: text,
                                key: keydetailpenjualan},
                        success:function(res){
                            // console.log(res);
                            
                            // alert(res);
                            if(statuscheck == "Proses Pengiriman"){
                                alert("Pengiriman Berhasil");
                            }else{
                                alert("Pembayaran Diterima");
                            }
                            window.location.href = "daftarpesanan.php";

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
            });

            // Create directions service and display route from user location to goal location
            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);
            var request = {
                origin: userLocation,
                destination: goalLocation,
                travelMode: 'DRIVING'
            };
            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(result);
                }
            });
        });
    }
</script>