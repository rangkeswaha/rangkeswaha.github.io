<?php

session_start();
unset($_SESSION['access_token']);

?>

<?php include "import.php"; ?>

<style>
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
</style>

<script>

  function refreshTable(){
        $('#example').DataTable( {
            responsive: true,
            "ajax": {
                "url": "ajax/notifikasi/getlistbarangdashboard.php",
                "dataSrc": ""
            },
            "columns": [
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html1  = "<button type='button' class='btn btn-secondary viewimage' id='ajax/tempatdistribusi/" + row.foto_pembeli + "' data-toggle='tooltip' data-html='true' title=\"<img id='gambartooltip'src='ajax/tempatdistribusi/" + row.foto_pembeli + "'>\">"+row.nama_pembeli+"</button>";
                        return html1;
                    }
                },
                // { "data": "nama_pembeli" },
                { "data": "jumlah_barang" },
                { "data": "total_harga" },
                { "data": "tanggal_pengiriman" },
                { "data": "tanggal_pembayaran" },
                { "data": "status_penjualan" },
                // { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                //         var html2 = "<td> <button type='button' id='"+row.key+".."+row.nama_pembeli+".."+row.jumlah_barang+".."+row.total_harga+".."+row.tanggal_pengiriman+".."+row.tanggal_pembayaran+".."+row.status_penjualan+".."+row.savedetail_address+".."+row.savelatitude+".."+row.savelongitude+".."+row.id_Nota_penjualan+"' class='btn btn-info detailpengiriman'></i>Detail Pengiriman</button></td>";
                //         return html2;
                //     }
                // },
                // { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                //         var html1  = "<td> <buttton type='button' id='"+row.id_Nota_penjualan+".."+row.tanggal_pengiriman+"' class='btn btn-info notapengiriman'>Nota Pengiriman</button></td>";
                //         return html1;
                //     }
                // },
            ]
        });
    }

    function refreshTablenotifikasi(){
        $('#examplenotifikasi').DataTable( {
            responsive: true,
            "ajax": {
                "url": "ajax/notifikasi/getnotifikasi.php",
                "dataSrc": ""
            },
            "columns": [
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html1  = "<button type='button' class='btn btn-secondary viewimage' id='ajax/tempatdistribusi/" + row.foto_pembeli + "' data-toggle='tooltip' data-html='true' title=\"<img id='gambartooltip'src='ajax/tempatdistribusi/" + row.foto_pembeli + "'>\">"+row.nama_pembeli+"</button>";
                        return html1;
                    }
                },
                // { "data": "nama_pembeli" },
                { "data": "jumlah_barang" },
                { "data": "total_harga" },
                { "data": "tanggal_pengiriman" },
                { "data": "tanggal_pembayaran" },
                { "data": "status_penjualan" },
                // { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                //         var html2 = "<td> <button type='button' id='"+row.key+".."+row.nama_pembeli+".."+row.jumlah_barang+".."+row.total_harga+".."+row.tanggal_pengiriman+".."+row.tanggal_pembayaran+".."+row.status_penjualan+".."+row.savedetail_address+".."+row.savelatitude+".."+row.savelongitude+".."+row.id_Nota_penjualan+"' class='btn btn-info detailpengiriman'></i>Detail Pengiriman</button></td>";
                //         return html2;
                //     }
                // },
                // { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                //         var html1  = "<td> <buttton type='button' id='"+row.id_Nota_penjualan+".."+row.tanggal_pengiriman+"' class='btn btn-info notapengiriman'>Nota Pengiriman</button></td>";
                //         return html1;
                //     }
                // },
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

    $(document).ready(function(){
        refreshTable();
        refreshTablenotifikasi();
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    });
</script>

<!DOCTYPE html>
<html>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="">
    <!-- begin header -->
    <?php include "header.php"; ?>
    <!-- end header -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row">
      <!-- begin sidebar -->
      <?php include "sidebar.php"; ?>
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
        <div class="content ">
          <div class="page-title">
            <h2>Dashboard</h2>
            <!-- <div style="display:flex; ">
                <button class="w3-button w3-black" style="border-radius: 15px;">Home</button>
                &nbsp;
                &nbsp;
                <button class="w3-button w3-black" style="border-radius: 15px;">Graph</button>
                &nbsp;
                &nbsp;
                <button class="w3-button w3-black" style="border-radius: 15px;">Notifikasi <span class="badge badge-important">1</span></button>
            </div> -->
          </div>
          <br>
          <div class="grid simple form-grid">
              <div class="grid-body no-border" style="border-radius: 10px;">
                  <br>
                  <!-- <form action="../ajax/inventory/codeaddbarangfix.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <div class="row form-row">
                              <div class="col-md-12">
                                <center>
                                  <h1>Dashboard Masih Kosong</h1>
                                </center>
                              </div>
                          </div>
                      </div>
                  </form> -->
                  <form id="formDaftarTempat">
                      <!-- table list Notifikasi -->
                      <h3>Tabel <span class="semi-bold">List Notifikasi Pembayaran</span></h3>
                      <!-- <p>Type something in the input field to search the table value</p>  
                      <input class="form-control" id="myInput" type="text" placeholder="Search..">   -->
                      <br>
                      <div class="table-responsive">
                          <table id="examplenotifikasi" class="table table-hover table-striped" style="width:100%">
                              <thead>
                              <tr>
                                  <th>Nama Penerima</th>
                                  <th>Total Barang</th>
                                  <th>Total Harga</th>
                                  <th>Tanggal Pengiriman</th>
                                  <th>Tanggal Pembayaran</th>
                                  <th>Status</th>
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
          <div class="grid simple form-grid">
              <div class="grid-body no-border" style="border-radius: 10px;">
                  <br>
                  <form id="formDaftarTempat">
                      <!-- table list Pesanan -->
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
                                  <!-- <th>Detail</th>
                                  <th>Nota</th> -->
                              </tr>
                              </thead>
                              <tbody>
                                  
                              </tbody>
                          </table>
                      </div>
                  </form>
              </div>
          </div>
          <div id="container">
            
          </div>
          <!-- END PAGE -->
        </div>
      </div>
      <!-- END CONTAINER -->
    </div>
 
  </body>
</html>