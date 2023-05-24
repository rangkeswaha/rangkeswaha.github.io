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
                "url": "../ajax/historypembelian/gethistorypembelian.php",
                "dataSrc": ""
            },
            "columns": [
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html1  = "<button type='button' class='btn btn-secondary viewimage' id='../ajax/inventory/" + row.foto_barang + "' data-toggle='tooltip' data-html='true' title=\"<img id='gambartooltip'src='../ajax/inventory/" + row.foto_barang + "'>\">"+row.nama_barang+"</button>";
                        return html1;
                    }
                },
                // { "data": "nama_pembeli" },
                { "data": "stok_dibeli" },
                { "data": "lama_pembelian"},
                { "data": "tanggal_pembelian"},
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

    // $(document).on("click",".detailpengiriman",function(){
    //     var selected = this;
    //     var id = this.id;

    //     var split = id.split("..");

    //     // alert(split[0]);
    //     // alert(split[1]);
    //     // alert(split[2]);
    //     // alert(split[3]);
    //     // alert(split[4]);
    //     // alert(split[5]);
    //     // alert(split[6]);
    //     // alert(split[7]);
    //     // alert(split[8]);
    //     // alert(split[9]);
    //     // alert(split[10]);

    //     // document.getElementById("imagePlaceModal").src= "/skripsi/apps/ajax/tempatdistribusi/" + split[3];
    //     // document.getElementById("namePlaceModal").value = split[4];
    //     // document.getElementById('deskripsiTempatModal').value = split[2];
    //     // document.getElementById('addressPlaceModal').value = split[1];

    //     // data detail //
    //     sessionStorage.setItem("historydetailpengirimankey", split[0]);
    //     sessionStorage.setItem("historydetailpengirimannamapembeli", split[1]);
    //     sessionStorage.setItem("historydetailpengirimanjumlahbarang", split[2]);
    //     sessionStorage.setItem("historydetailpengirimantotalharga", split[3]);
    //     sessionStorage.setItem("historydetailpengirimantanggalpengiriman", split[4]);
    //     sessionStorage.setItem("historydetailpengirimantanggalpembayaran", split[5]);
    //     sessionStorage.setItem("historydetailpengirimanstatuspenjualan", split[6]);
    //     sessionStorage.setItem("historydetailpengirimandetailaddress", split[7]);
    //     sessionStorage.setItem("historydetailpengirimanlatitude", split[8]);
    //     sessionStorage.setItem("historydetailpengirimanlongitude", split[9]);
    //     sessionStorage.setItem("historydetailpengirimanidnota", split[10]);
    //     window.location.href = "historydetailpengiriman.php";


    //     // sessionStorage.setItem("key", split[0]);

    //     // modal = document.getElementById("myModal");
    //     // modal.style.display = "block";


    //     // $("#formeditkategori").attr("value", "");
    //     // $("#formeditkategori").attr("value", kategoriawal);
    //     // document.getElementById('formeditkategori').value = kategoriawal;

    //     // alert(kategoriawal);
    // });

    // $(document).on("click",".notapengiriman",function(){
    //     var selected = this;
    //     var id = this.id;

    //     var split = id.split("..");

    //     // alert(split);

    //     // data nota //
    //     sessionStorage.setItem("historynotaid", split[0]);
    //     sessionStorage.setItem("historynotapengiriman", split[1]);
    //     window.location.href = "historynotapengiriman.php";

    // });

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
                <li><a href="/skripsi/apps/history_pembelian/historypembelian.php" class="active">List Pembelian</a> </li>
            </ul>
            <div class="page-title">
                <h3>Riwayat Pembelian Stok - <span class="semi-bold">List Pembelian</span></h3>
            </div>
            <div class="grid simple form-grid">
                <div class="grid-body no-border" style="border-radius: 10px;">
                    <br>
                    <form id="formDaftarTempat">
                        <!-- table list tempat distribusi -->
                        <h3>Tabel <span class="semi-bold">Riwayat Pembelian</span></h3>
                        <!-- <p>Type something in the input field to search the table value</p>  
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">   -->
                        <br>
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Stok Dibeli</th>
                                    <th>Lama Pembelian</th>
                                    <th>Tanggal Pembelian</th>
                                    <!-- <th>Tanggal Pembayaran</th>
                                    <th>Status</th>
                                    <th>Detail</th>
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
