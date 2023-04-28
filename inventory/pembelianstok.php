<!DOCTYPE html>
<html>
<?php 
session_start();
include "../import.php"; ?>
<link rel="stylesheet" href="pembelianstok.css">
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
            <div class="page-title">
                <h3>Pembelian Stok Barang</h3>
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
                    <form method="POST" id="pembelianbarang" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;">Pilih Barang</label>
                            <label>Pencarian Barang</label>
                            <input style="border-radius: 10px;" class="form-control" id="myInput" type="text" placeholder="Nama barang"> 
                            <br>
                            <div class="row form-row" style="border-radius: 15px; background-color: #eeeeee;">
                                <div style="margin-left: 0.5%; margin-right: 0.5%; margin-bottom: 2.5%;" class="row form-row" id="viewBarang" name="viewBarang">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-8">
                                    <label>Nama Barang</label>
                                    <input readonly name="namegoods" id="namegoods" type="text"
                                        class="form-control" placeholder="Telur" value="">
                                </div>
                                <div class="col-md-4">
                                    <label>Tanggal Pembelian</label>
                                    <input name="buydategoods" id="buydategoods" type="date"
                                        class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <label>Lama Pembelian</label>
                                    <input name="buylengthgoods" id="buylengthgoods" type="number"
                                        class="form-control" placeholder="Berapa hari" value="">
                                </div>
                                <div class="col-md-6">
                                    <label>Jumlah Stok (kg)</label>
                                    <input name="stockgoods" id="stockgoods" type="number"
                                        class="form-control" placeholder="10" value="">
                                </div>
                            </div>
                        </div>
                        
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
                                    <th>Tanggal Pembelian</th>
                                    <th>Lama Pembelian</th>
                                    <th>Stok Barang</th>
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
                            <div>
                                <center>
                                <button type="submit" id="savebutton" name="savebutton" style="background-color: #53a551; color: white;" class="btn btn-cons"><i class="icon-ok"></i>
                                Simpan Stok</button>
                                </center>
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
    var allnewstock = [];

    $('#addbutton').click(function(){
          var namegoods = $("#namegoods").val();
          var stockgoods = $("#stockgoods").val();
          var buylengthgoods = $("#buylengthgoods").val();
          var buydategoods = $("#buydategoods").val();
        
        // if(namegoods == "" && stockgoods == "" && buylengthgoods == "" && buydategoods == ""){
        //   alert("Tolong Lengkapi Data Terlebih Dahulu")
        // }else{

          // alert(allbarang[0].key);

          for (var i = 0; i < allbarang.length; i++){
            if(namegoods == allbarang[i].nama_barang){
              allnewstock.push({
                  namegoods: namegoods,
                  stockgoods: stockgoods,
                  buylengthgoods: buylengthgoods,
                  buydategoods: buydategoods,
                  firststockgoods: allbarang[i].stok_barang,
                  key: allbarang[i].key,
              });
            }
          }

          var str = "";

          for (var i = 0; i < allnewstock.length; i++){
            str += "<tr>"+
            "<td>"+allnewstock[i].namegoods+"</td>"+
            "<td>"+allnewstock[i].stockgoods+"</td>"+
            "<td>"+allnewstock[i].buylengthgoods+"</td>"+
            "<td>"+allnewstock[i].buydategoods+"</td>"+
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

    $(document).ready(function() {
      $('#pembelianbarang').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var allnewdata = JSON.stringify(allnewstock);
        $.ajax({
          type: 'POST',
          url: '../ajax/inventory/codepembelianbarang.php',
          data: { allnewdata:allnewdata },
          success: function(response) {
            // console.log(response);
            alert("Data Berhasil Disimpan");
            allnewstock.length = 0;
            var str = "";
            $("#tablegoods").html(str);
          },
          error: function(a, err){
              //lakukan sesuatu untuk handle error
              alert("Data Gagal Disimpan");
          },
        });
      });
    });

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
          "<td>"+allnewstock[i].buylengthgoods+"</td>"+
          "<td>"+allnewstock[i].buydategoods+"</td>"+
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