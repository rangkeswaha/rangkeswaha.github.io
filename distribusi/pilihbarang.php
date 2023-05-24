<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>
<html>
<?php 
session_start();
include "../import.php"; ?>
<!-- <link rel="stylesheet" href="pembelianstok.css"> -->

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>

<script>
    // untuk membatasi grid yang ditampilkan
    // var defaultgrid = 5;
    
    var allbarang;

    function getbarang() {
      $.ajax({
        url: "../ajax/inventory/getbarangandkey.php",
        success:function(isi)
        {
          var data = JSON.parse(isi);
          allbarang = data;

          // alert(data[1].harga_barang);
          var str = '';
          for (var i = 0; i < data.length; i++){
            str += '<div class="col-md-3" onclick="detailbarang(\''+data[i].key+'\')">'+
              '<div class="card">'+
                '<center>'+
                '<br>'+
                '<img src="/skripsi/apps/ajax/inventory/'+data[i].foto_barang+'" alt="Avatar" style="width: 200px; height: 200px; border-radius: 15px;">'+
                '</center>'+
                '<div class="container">'+
                  '<h4><b>'+data[i].nama_barang+'</b></h4> '+
                  '<h4>Rp '+data[i].harga_barang+' per kg</h4>'+
                  '<p>Stok '+data[i].stok_barang+'kg</p> '+
                '</div></div></div>';
          }

          // alert(data[1].nama);
          // alert(str);
          

          $("#viewBarang").html(str);

          // var str = '';
          // str += '<option value="">Select Cabang</option>';    
          // for(var i=0;i<data.length;i++){
          // str += '<option value="'+data[i].kode_cabang+'_'+data[i].nama_cabang+'">'+ data[i].nama_cabang +'</option>';                 
          // }
          //     $("#selectCabang").html(str);
          // }
        }
      });
    }

    function detailbarang(key){
      sessionStorage.setItem("keystokbarang", key);
      // alert('key telah tersimpan = ' + key);

      for (var i = 0; i < allbarang.length; i++){
        if(allbarang[i].key == key){
          // alert(allbarang[i].halo);
          document.getElementById('namegoods').value = allbarang[i].nama_barang;
        }
      }
    }

    function getallkategorioption(){
        $.ajax({
          url: "../ajax/masterkategori/getallkategori.php",
          success:function(isi)
          {
            var data = JSON.parse(isi);

            var str = '';
            str += '<div class="col-md-12">';
            str += '<div class=" right">';
            str += '<select class="form-control select2" id="selectKategori" name="selectKategori" data-init-plugin="select2" required>';
            str += '<option value="">Pilih Kategori</option>';
            for(var i=0;i<data.length;i++){
                str += '<option value="'+data[i].kategori+'_'+data[i].key+'">'+ data[i].kategori +'</option>';
            }
            str += '</select></div></div>';

            $("#formkategori").html(str);
            // alert('str');
            // const element = document.getElementById("selectkategori");
            // element.innerHTML = str;
            // alert(data[0].key);
            
          }
        });
    }

    $(document).ready(function(){
        getbarang();
        getallkategorioption();

        // ambil session storage
        // var myValue = sessionStorage.getItem('dislongitude');
        // alert(myValue);

        // $('#tabel-data').DataTable();

        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            var str = '';
            for (var i = 0; i < allbarang.length; i++){
              if (allbarang[i].nama_barang.toLowerCase().includes(value.toLowerCase())){
                str += '<div class="col-md-3" onclick="detailbarang(\''+allbarang[i].key+'\')">'+
                  '<div class="card">'+
                    '<center>'+
                    '<br>'+
                    '<img src="/skripsi/apps/ajax/inventory/'+allbarang[i].foto_barang+'" alt="Avatar" style="width: 200px; height: 200px; border-radius: 15px;">'+
                    '</center>'+
                    '<div class="container">'+
                      '<h4><b>'+allbarang[i].nama_barang+'</b></h4> '+
                      '<h4>Rp '+allbarang[i].harga_barang+' per kg</h4>'+
                      '<p>Stok '+allbarang[i].stok_barang+'kg</p> '+
                    '</div></div></div>';
              }
              else{
                // str = '<center><h4>Data Tidak Ada</h4></center>';
              }
            }    

            if(str == ''){
                str = '<div style="margin-top: 2.5%;"><center><h1>Data Tidak Ada</h1></center></div>';
            }

            $("#viewBarang").html(str);
        });
    });
    document.onload = function () {
        getallkategorioption();
    };
</script>
<style>
  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 100%;
    border-radius: 15px;
    margin-top: 25px;
    cursor: pointer;
    background-color: white;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  .container {
    padding: 2px 16px;
  }
</style>
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
                <li><a href="/skripsi/apps/distribusi/pesanan.php" class="#">Pilih Tempat</a> </li>
                <li><a href="/skripsi/apps/distribusi/pilihbarang.php" class="active">Pilih Barang</a> </li>
            </ul>
            <div class="page-title">
                <h3>Pengiriman - <span class="semi-bold">Pilih Barang</span></h3>
            </div>
            <?php
                if(isset($_SESSION['status'])){
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."<h5>";
                    unset($_SESSION['status']);
                }
            ?>
            <div class="grid simple form-grid">
                <div class="grid-body no-border" style="border-radius: 10px;">
                    <br>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <label>Nama Barang</label>
                                    <input readonly name="namegoods" id="namegoods" type="text"
                                        class="form-control" placeholder="Telur" value="">
                                </div>
                                <div class="col-md-6">
                                    <label>Jumlah Stok (kg)</label>
                                    <input name="stockgoods" id="stockgoods" type="number"
                                        class="form-control" placeholder="10" value="">
                                </div>
                            </div> 
                        </div>
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <label>Tanggal Penjualan/Pengiriman</label>
                                    <input type="text" id="saledategoods" placeholder="Pilih Tanggal dan Waktu" autocomplete="off" />
                                    <!-- <input name="saledategoods" id="saledategoods" type="date"
                                        class="form-control" value=""> -->
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Pembayaran</label>
                                    <input name="paydategoods" id="paydategoods" type="date"
                                        class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row form-row">
                                <label style="margin-left: 1.7%;">Waktu Penjualan/Pengiriman</label>
                                <div class="col-md-2">
                                    <input type="time" id="timegoods" name="timegoods" class="form-control">
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="pull-right">
                                <button type="button" id="addbutton" name="addbutton" class="btn btn-success btn-cons"><i class="icon-ok"></i>
                                Tambah</button>
                            </div>
                        </div>
                        <br><br><br>
                        <!-- table list barang -->
                        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Stok Barang</th>
                                    <th>Tanggal Pengiriman/Penjualan</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="tablegoods">
                                <!-- <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                </tr> -->
                            </tbody>
                        </table>
                        <div class="form-group" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="pull-right">
                                <!-- <center> -->
                                <button type="button" id="nextbutton" name="nextbutton" style="background-color: #53a551; color: white;" class="btn btn-cons"><i class="icon-ok"></i>
                                Lanjut Transaksi</button>
                                <!-- </center> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 0%; margin-top: 1%;">Pilih Barang</label>
                            <label>(Pilih barang yang akan dijual)</label>
                            <label class="form-label" style="font-size:15px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;">Pencarian Barang</label>
                            <!-- <label>Pencarian Barang</label> -->
                            <input style="border-radius: 10px;" class="form-control" id="myInput" type="text" placeholder="Nama barang"> 
                            <br>
                            <div class="row form-row" style="border-radius: 15px; background-color: #eeeeee;">
                                <div style="margin-left: 0.5%; margin-right: 0.5%; margin-bottom: 2.5%;" class="row form-row" id="viewBarang" name="viewBarang">
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

<style>
  #saledategoods {
    border: 1px solid rgba(0, 0, 0, 0.15);
    font-family: inherit;
    font-size: inherit;
    padding: 8px;
    border-radius: 0px;
    outline: none;
    display: block;
    margin: 0 0 20px 0;
    width: 100%;
    box-sizing: border-box;
  }
</style>


<script>
    var allnewstock = [];

    // Selected time should not be less than current time
    function AdjustMinTime(ct) {
      var dtob = new Date(),
          current_date = dtob.getDate(),
          current_month = dtob.getMonth() + 1,
          current_year = dtob.getFullYear();
            
      var full_date = current_year + '-' +
              ( current_month < 10 ? '0' + current_month : current_month ) + '-' + 
                ( current_date < 10 ? '0' + current_date : current_date );

      if(ct.dateFormat('Y-m-d') == full_date)
        this.setOptions({ minTime: 0 });
      else 
        this.setOptions({ minTime: false });
    }

    // DateTimePicker plugin : http://xdsoft.net/jqplugins/datetimepicker/
    $("#saledategoods").datetimepicker({ format: 'Y-m-d H:i', minDate: 0, minTime: 0, step: 5, onShow: AdjustMinTime, onSelectDate: AdjustMinTime });

    $('#addbutton').click(function(){
          var namegoods = $("#namegoods").val();
          var stockgoods = $("#stockgoods").val();
          var paydategoods = $("#paydategoods").val();
          var saledategoods = $("#saledategoods").val();
        
          // if(namegoods == "" && stockgoods == "" && buylengthgoods == "" && buydategoods == ""){
          //   alert("Tolong Lengkapi Data Terlebih Dahulu")
          // }else{

          // alert(allbarang[0].nama_barang);
          // alert("masuk");

          // Date Application //
          var date = $("#saledategoods").val().replace(' ', 'T') + ':00';
          // alert(date);

          var dateslice = date.slice(0, 10);
          var timeslice = date.slice(11);
          // alert(dateslice);
          // alert(timeslice);

          var timetemp = new Date(`1970-01-01T${timeslice}`);
          timetemp.setMinutes(timetemp.getMinutes() + 30);
          var newTimeString = timetemp.toTimeString().slice(0, 8);
          // alert(newTimeString);

          var dateTimeString = `${dateslice}T${newTimeString}`;
          // alert(dateTimeString);

          sessionStorage.setItem("starttime", date);
          sessionStorage.setItem("endtime", dateTimeString);

          // cek date type data //
          // if (typeof date === typeof dateTimeString) {
          //   alert("the same");
          // }


          for (var i = 0; i < allbarang.length; i++){
            if(namegoods == allbarang[i].nama_barang){
              allnewstock.push({
                  namegoods: namegoods,
                  stockgoods: stockgoods,
                  paydategoods: paydategoods,
                  saledategoods: dateTimeString,
                  firststockgoods: allbarang[i].stok_barang,
                  key: allbarang[i].key,
                  pricegoods: allbarang[i].harga_barang,
              });
            }
          }

          // alert(allnewstock.length);

          document.getElementById("namegoods").value = "";

          var str = "";

          for (var i = 0; i < allnewstock.length; i++){
            str += "<tr>"+
            "<td>"+allnewstock[i].namegoods+"</td>"+
            "<td>"+allnewstock[i].stockgoods+"</td>"+
            "<td>"+allnewstock[i].saledategoods+"</td>"+
            "<td>"+allnewstock[i].paydategoods+"</td>"+
            "<td> <buttton id='del_"+i+"' class='btn btn-danger delStock'>Delete</button></td>"+
            "</tr>";
          }

          // '<p>Stok '+data[i].stok_barang+'kg</p> '+
          $("#tablegoods").html(str);
        // }
    });

    // $(document).on("click",".savebutton",function(){
    //     $.ajax({
    //         url: '../ajax/inventory/codepembelianbarang.php',
    //         type: 'POST',
    //         data: { allnewstock:allnewstock },
    //         success: function(response){
    //             // alert(response);
    //             // $(selected).closest('tr').fadeOut(800,function(){
    //             //     $(this).remove();
    //             // });
    //             alert("Data Berhasil Disimpan");
    //         },
    //         error: function(a, err){
    //             //lakukan sesuatu untuk handle error
    //             alert("Data Gagal Disimpan");
    //         }
    //     });
    // });

    // $(document).on("click",".nextbutton",function(){
    //   sessionStorage.setItem("allneworder", allnewstock);

    //   window.location.href = "catatanbarang.php";

    // });

    $('#nextbutton').click(function(){
      // Convert the array to a string and store it in session storage
      sessionStorage.setItem('allneworder', JSON.stringify(allnewstock));

      window.location.href = "catatanbarang.php";
    });

    // $(document).ready(function() {
    //   $('#pembelianbarang').submit(function(event) {
    //     event.preventDefault();
    //     var formData = $(this).serialize();
    //     var allnewdata = JSON.stringify(allnewstock);
    //     $.ajax({
    //       type: 'POST',
    //       url: '../ajax/inventory/codepembelianbarang.php',
    //       data: { allnewdata:allnewdata },
    //       success: function(response) {
    //         // console.log(response);
    //         alert("Data Berhasil Disimpan");
    //         allnewstock.length = 0;
    //         var str = "";
    //         $("#tablegoods").html(str);
    //         // Reload the current page
    //         location.reload();
    //       },
    //       error: function(a, err){
    //           //lakukan sesuatu untuk handle error
    //           alert("Data Gagal Disimpan");
    //       },
    //     });
    //   });
    // });

    // $(document).ready(function() {
    //   $('#catatanbarang').submit(function(event) {
    //     sessionStorage.setItem("allneworder", allnewstock);

    //     window.location.href = "catatanbarang.php";
    //   });
    // });

    $(document).on("click",".delStock",function(){
        var selected = this;
        var id = this.id;
        // alert(id);

        var split = id.split("_");

        // alert(split);

        kategoriawal = split[0];
        rownumber = split[1];

        allnewstock.splice(rownumber, 1);

        var str = "";

        for (var i = 0; i < allnewstock.length; i++){
          str += "<tr>"+
          "<td>"+allnewstock[i].namegoods+"</td>"+
          "<td>"+allnewstock[i].stockgoods+"</td>"+
          "<td>"+allnewstock[i].saledategoods+"</td>"+
          "<td>"+allnewstock[i].paydategoods+"</td>"+
          "<td> <buttton id='del_"+i+"' class='btn btn-danger delStock'>Delete</button></td>"+
          "</tr>";
        }

        $("#tablegoods").html(str);
        
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