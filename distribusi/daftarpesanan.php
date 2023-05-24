<!DOCTYPE html>
<html>
<?php 
session_start();
include "../import.php"; ?>
<link rel="stylesheet" href="../inventory/tambahbarang.css">

<style>
    #map {
        height: 400px;
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

    function refreshTable(){
        $('#example').DataTable( {
            responsive: true,
            "ajax": {
                "url": "../ajax/distribusi/getlistpesanan.php",
                "dataSrc": ""
            },
            "columns": [
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html1  = "<button type='button' class='btn btn-secondary viewimage' id='../ajax/tempatdistribusi/" + row.foto_pembeli + "' data-toggle='tooltip' data-html='true' title=\"<img id='gambartooltip'src='../ajax/tempatdistribusi/" + row.foto_pembeli + "'>\">"+row.nama_pembeli+"</button>";
                        return html1;
                    }
                },
                // { "data": "nama_pembeli" },
                { "data": "jumlah_barang" },
                { "data": "total_harga" },
                { "data": "tanggal_pengiriman" },
                { "data": "tanggal_pembayaran" },
                { "data": "status_penjualan" },
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html2 = "<td> <button type='button' id='"+row.key+".."+row.nama_pembeli+".."+row.jumlah_barang+".."+row.total_harga+".."+row.tanggal_pengiriman+".."+row.tanggal_pembayaran+".."+row.status_penjualan+".."+row.savedetail_address+".."+row.savelatitude+".."+row.savelongitude+".."+row.id_Nota_penjualan+"' class='btn btn-info detailpengiriman'></i>Detail Pengiriman</button></td>";
                        return html2;
                    }
                },
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html1  = "<td> <buttton type='button' id='"+row.id_Nota_penjualan+".."+row.tanggal_pengiriman+"' class='btn btn-info notapengiriman'>Nota Pengiriman</button></td>";
                        return html1;
                    }
                },
            ]
        });
    }

    $(document).on("click",".viewimage",function(){
        var selected = this;
        var id = this.id;

        var split = id.split("..");

        // alert(split[1]);

        // window.location.replace("/skripsi/apps" + split[1]);
        window.location.href = "/skripsi/apps" + split[1];

       
    });

    $(document).on("click",".detailpengiriman",function(){
        var selected = this;
        var id = this.id;

        var split = id.split("..");

        // alert(split[0]);
        // alert(split[1]);
        // alert(split[2]);
        // alert(split[3]);
        // alert(split[4]);
        // alert(split[5]);
        // alert(split[6]);
        // alert(split[7]);
        // alert(split[8]);
        // alert(split[9]);
        // alert(split[10]);

        // document.getElementById("imagePlaceModal").src= "/skripsi/apps/ajax/tempatdistribusi/" + split[3];
        // document.getElementById("namePlaceModal").value = split[4];
        // document.getElementById('deskripsiTempatModal').value = split[2];
        // document.getElementById('addressPlaceModal').value = split[1];

        // data detail //
        sessionStorage.setItem("detailpengirimankey", split[0]);
        sessionStorage.setItem("detailpengirimannamapembeli", split[1]);
        sessionStorage.setItem("detailpengirimanjumlahbarang", split[2]);
        sessionStorage.setItem("detailpengirimantotalharga", split[3]);
        sessionStorage.setItem("detailpengirimantanggalpengiriman", split[4]);
        sessionStorage.setItem("detailpengirimantanggalpembayaran", split[5]);
        sessionStorage.setItem("detailpengirimanstatuspenjualan", split[6]);
        sessionStorage.setItem("detailpengirimandetailaddress", split[7]);
        sessionStorage.setItem("detailpengirimanlatitude", split[8]);
        sessionStorage.setItem("detailpengirimanlongitude", split[9]);
        sessionStorage.setItem("detailpengirimanidnota", split[10]);
        window.location.href = "detailpesanan.php";


        // sessionStorage.setItem("key", split[0]);

        // modal = document.getElementById("myModal");
        // modal.style.display = "block";


        // $("#formeditkategori").attr("value", "");
        // $("#formeditkategori").attr("value", kategoriawal);
        // document.getElementById('formeditkategori').value = kategoriawal;

        // alert(kategoriawal);
    });

    $(document).on("click",".notapengiriman",function(){
        var selected = this;
        var id = this.id;

        var split = id.split("..");

        // alert(split);

        // data nota //
        sessionStorage.setItem("notaid", split[0]);
        sessionStorage.setItem("notapengiriman", split[1]);
        window.location.href = "notapesanan.php";

    });

    // $(document).on("click",".deleteTempat",function(){
    //     var selected = this;
    //     var id = this.id;
    //     // alert(id);

    //     var split = id.split("..");

    //     // alert(split);

    //     keyawal = split[0];

    //     // AJAX Request
    //     let confirmAction = confirm("Data Akan Dihapus?");
    //     if (confirmAction) {
    //         $.ajax({
    //             url: '../ajax/tempatdistribusi/deletetempatdis.php',
    //             type: 'POST',
    //             data: { keyawal:keyawal,},
    //             success: function(response){
    //                 alert('Data Telah Dihapus');
    //                 $('#example').DataTable().ajax.reload();
    //             },
    //             error: function(a, err){
    //                 //lakukan sesuatu untuk handle error
    //                 alert("Gagal delete");
    //             }
    //         });
    //     }
    // });

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeModal")[0];


    function btnModal() {
        modal.style.display = "block";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    $(document).ready(function(){
        refreshTable();
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
                <li><a href="/skripsi/apps/distribusi/daftarpesanan.php" class="active">List Pesanan</a> </li>
            </ul>
            <div class="page-title">
                <h3>List Pesanan - <span class="semi-bold">List Pesanan</span></h3>
            </div>
            <div class="grid simple form-grid">
                <div class="grid-body no-border" style="border-radius: 10px;">
                    <br>
                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span onclick="closeModal()" class="closeModal">&times;</span>
                            <h3>Data Tempat</h3>
                            <br><br>
                            <div id="modalBody">
                            <label>Gambar Tempat</label>
                            <img id="imagePlaceModal" name="imagePlaceModal" src="/skripsi/apps/ajax/inventory/uploads/1823profile 2.jpg" alt="Avatar" style="width: 200px; height: 200px; border-radius: 15px;">
                            <br><br>
                            <div class="form-group">
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <!-- BEGIN TAG INPUTS / FILE UPLOADER CONTROLS-->
                                        <div class="fallback">
                                            <input id="uploadImageModal" name="uploadImageModal" type="file"/>
                                        </div>
                                        <!-- END TAG INPUTS / FILE UPLOADER CONTROLS-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <label>Nama Tempat</label>
                                        <input name="namePlaceModal" id="namePlaceModal" type="text" class="form-control" placeholder="Hotel" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <label class="form-label">Deskripsi Tempat</label>
                                        <br>
                                        <textarea rows="4" style="width: 100%;" id="deskripsiTempatModal" name="deskripsiTempatModal" placeholder="Tulis Disini......."></textarea>
                                        <!-- <textarea name="formdeskripsi" id="" cols="30" rows="10"></textarea> -->
                                        <!-- <input name="formdeskripsi" id="formdeskripsi" type="textarea"class="form-control" placeholder="Tulis Disini......." value=""> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <label class="form-label">Alamat Tempat</label>
                                        <br>
                                        <textarea rows="4" style="width: 100%;" id="addressPlaceModal" name="addressPlaceModal" placeholder="Tulis Disini......."></textarea>
                                        <!-- <textarea name="formdeskripsi" id="" cols="30" rows="10"></textarea> -->
                                        <!-- <input name="formdeskripsi" id="formdeskripsi" type="textarea"class="form-control" placeholder="Tulis Disini......." value=""> -->
                                    </div>
                                </div>
                            </div>
                            <!-- map di modal masih error karena memakai 2 map di satu page -->
                            <!-- <div class="form-group">
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <label class="form-label">Tempat Berdasarkan Map</label>
                                        <br>
                                        <input type="text" id="address-inputModal">
                                        <button type="button" onclick="geocodeAddressModal()">Check Place</button>
                                        <div id="mapModal"></div>
                                        
                                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw&libraries=places&callback=initMapModal"></script>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="submit" id="editTempat" name="editTempat" class="btn btn-success btn-cons"><i class="icon-ok"></i>
                                        Simpan</button>
                                </div>
                                <br>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <form id="formDaftarTempat">
                        <!-- table list tempat distribusi -->
                        <h3>Tabel <span class="semi-bold">List Pesanan</span></h3>
                        <!-- <p>Type something in the input field to search the table value</p>  
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">   -->
                        <br>
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nama Penerima</th>
                                    <th>Total Barang</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                    <th>Nota</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
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

    $('#saveTempat').click(function(){
        //to grab longitude, latitude and detail address
        // Get the address input element
        const addressInput = document.getElementById('address-input');

        // Geocode the entered address
        geocoder.geocode({ address: addressInput.value }, (results, status) => {
            if (status === 'OK') {
            // Center the map on the geocoded location
            map.setCenter(results[0].geometry.location);
            map.setZoom(16);

            // Remove any existing marker from the map
            if (marker) {
                marker.setMap(null);
            }

            // Create a new marker at the geocoded location
            marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                draggable: true
            });

            // When the user drags the marker, update the address input with the new location
            marker.addListener('dragend', () => {
                geocoder.geocode({ location: marker.getPosition() }, (results, status) => {
                    if (status === 'OK') {
                        if (results[0]) {
                        document.getElementById('address-input').value = results[0].formatted_address;
                        }
                    }
                });
            });

            // Get the latitude, longitude, and formatted address of the geocoded location
            const latitude = results[0].geometry.location.lat();
            const longitude = results[0].geometry.location.lng();
            const formattedAddress = results[0].formatted_address;

            // Display the latitude, longitude, and formatted address in an alert
            // alert(`Latitude: ${latitude}\nLongitude: ${longitude}\nAddress: ${formattedAddress}`);

            savelatitude = latitude;
            savelongitude = longitude;
            savedetail_address = formattedAddress;

            var nama = $("#namePlace").val();
            var alamat = $("#addressPlace").val();
            var deskripsi = $("#deskripsiTempat").val();
            var foto = $("#fotoTempat")[0].files;
        

            var form_data = new FormData();
            form_data.append("nama", nama);
            form_data.append("alamat", alamat);
            form_data.append("deskripsi", deskripsi);
            form_data.append("namafoto", foto[0]);
            form_data.append("savelatitude", savelatitude);
            form_data.append("savelongitude", savelongitude);
            form_data.append("savedetail_address", savedetail_address);

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
            } else {
                alert('Masukan Alamat');
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
