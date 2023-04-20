<!DOCTYPE html>
<html>
<?php 
session_start();
include "../import.php"; ?>
<link rel="stylesheet" href="tambahbarang.css">
<script>
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
                str += '<option id="'+data[i].kategori+'" value="'+data[i].kategori+'_'+data[i].key+'">'+ data[i].kategori +'</option>';
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
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

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
                <h3>Stok Barang</h3>
            </div>
            <div class="grid simple form-grid">
                <div class="grid-body no-border" style="border-radius: 10px;">
                    <br>
                    <form action="../ajax/inventory/editdeletebarang.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;">Data Barang</label>
                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                              <!-- Modal content -->
                              <div class="modal-content">
                                  <span onclick="closeModal()" class="closeModal">&times;</span>
                                  <h3>Data Barang</h3>
                                  <br><br>
                                  <div id="modalBody">
                                  <label>Gambar Barang</label>
                                  <img id="gambarbarangmodal" name="gambarbarangmodal" src="/skripsi/apps/ajax/inventory/uploads/1823profile 2.jpg" alt="Avatar" style="width: 200px; height: 200px; border-radius: 15px;">
                                  <br><br>
                                  <div class="form-group">
                                      <div class="row form-row">
                                          <div class="col-md-12">
                                              <!-- BEGIN TAG INPUTS / FILE UPLOADER CONTROLS-->
                                              <div class="fallback">
                                                  <input id="fotobarang" accept="image/*" name="fotobarang" type="file"/>
                                              </div>
                                              <!-- END TAG INPUTS / FILE UPLOADER CONTROLS-->
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-md-8">
                                                <label>Nama Barang</label>
                                                <input name="namegoods" id="namegoods" type="text"
                                                    class="form-control" placeholder="Telur" value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Harga Barang per Kilo</label>
                                                <input name="pricegoods" style="text-align: center;" id="pricegoods" type="number"
                                                    class="form-control currency" min="0" placeholder="100000" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-md-6">
                                                <label>Jumlah Stok (kg)</label>
                                                <input name="stockgoods" id="stockgoods" type="text"
                                                    class="form-control" placeholder="10" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Kategori</label>
                                                <span class="help" id="labelPegawai">Contoh "Daging Mentah"</span>
                                                <div class="row form-row" id="formkategori">
                                                    <div class="col-md-12">
                                                        <div class=" right">
                                                            <!-- <i class=""></i> -->
                                                            <select class="form-control select2" id="selectKategori" name="selectKategori" data-init-plugin="select2" required>
                                                                <option value="">
                                                                    Pilih Kategori
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-md-12">
                                                <label class="form-label">Deskripsi Barang</label>
                                                <br>
                                                <textarea rows="4" style="width: 100%;" id="formdeskripsi" name="formdeskripsi" placeholder="Tulis Disini......."></textarea>
                                                <!-- <textarea name="formdeskripsi" id="" cols="30" rows="10"></textarea> -->
                                                <!-- <input name="formdeskripsi" id="formdeskripsi" type="textarea"class="form-control" placeholder="Tulis Disini......." value=""> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="pull-right">
                                            <button type="submit" id="editBarang" name="editBarang" class="btn btn-success btn-cons"><i class="icon-ok"></i>
                                                Simpan</button>
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" id="deleteBarang" name="deleteBarang" class="btn btn-danger btn-cons"><i class="icon-ok"></i>
                                                Hapus Barang</button>
                                        </div>
                                        <br>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <input type="hidden" value="" id="oldImage" name="oldImage">
                            <input type="hidden" value="" id="keyBarang" name="keyBarang">
                            <div class="row form-row" id="viewBarang" name="viewBarang">
                                <!-- <div class="col-md-3">
                                  <div class="card">
                                    <center>
                                    <br>
                                    <img src="/skripsi/apps/ajax/inventory/uploads/1823profile 2.jpg" alt="Avatar" style="width: 200px; height: 200px; border-radius: 15px;">
                                    </center>
                                    <div class="container">
                                      <h4><b>Telur Ayam</b></h4> 
                                      <h4>Rp 50000 per kg</h4>
                                      <p>Stok 150kg</p> 
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="card">
                                    <center>
                                    <br>
                                    <img src="/skripsi/apps/ajax/inventory/uploads/1823profile 2.jpg" alt="Avatar" style="width: 200px; height: 200px; border-radius: 15px;">
                                    </center>
                                    <div class="container">
                                      <h4><b>Telur Ayam</b></h4> 
                                      <h4>Rp 50000 per kg</h4>
                                      <p>Stok 150kg</p> 
                                    </div>
                                  </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- table list barang -->
                        <!-- <div class="form-group">
                            <table id="example" class='table - table-bordered table-stripped'>
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Stok Barang</th>
                                    </tr>
                                </thead>
                                <tbody id="listbarang">
                                    
                                </tbody>
                            </table>
                        </div> -->
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

    // $('#editBarang').click(function(){
    //     alert('Edit');
    // });

    // $('#hapusBarang').click(function(){
    //     alert('Delete');
    // });

    function detailbarang(key){
      sessionStorage.setItem("keystokbarang", key);
      // alert('key telah tersimpan = ' + key);
      modal = document.getElementById("myModal");
      modal.style.display = "block";

      for (var i = 0; i < allbarang.length; i++){
        if(allbarang[i].key == key){
          // alert(allbarang[i].halo);
          document.getElementById("gambarbarangmodal").src= "/skripsi/apps/ajax/inventory/" + allbarang[i].foto_barang;
          document.getElementById('oldImage').value = allbarang[i].foto_barang;
          document.getElementById('keyBarang').value = allbarang[i].key;
          document.getElementById('namegoods').value = allbarang[i].nama_barang;
          document.getElementById('pricegoods').value = allbarang[i].harga_barang;
          document.getElementById('stockgoods').value = allbarang[i].stok_barang;
          document.getElementById('formdeskripsi').value = allbarang[i].deskripsi_barang;
          document.getElementById(allbarang[i].kategori_barang).selected = true;
        }
      }
    }

    // $('#savebarangbutton').click(function(){
    //     var namegoods = $("#namegoods").val();
    //     var stockgoods = $("#stockgoods").val();
    //     var pricegoods = $("#pricegoods").val();
    //     var selectKategori = $("#selectKategori").val();
    //     var formdeskripsi = $("#formdeskripsi").val();
    //     var fotobarang = $("#fotobarang").prop('files')[0];

    //     var splitkategori = selectKategori.split("_");
    //     var kategoribarang = splitkategori[0];
        
    //     alert(namegoods);

    //     var form_data = new FormData();
    //     form_data.append("namegoods", namegoods);
    //     form_data.append("stockgoods", stockgoods);
    //     form_data.append("pricegoods", pricegoods);
    //     form_data.append("kategoribarang", kategoribarang);
    //     form_data.append("formdeskripsi", formdeskripsi);
    //     form_data.append("file", fotobarang);

    //     // alert(form_data[0])

    //     // $.ajax({
    //     // url: "../ajax/inventory/codeaddbarang.php",
    //     // type:"post",
    //     // data:{
    //     //     namegoods:namegoods,
    //     //     stockgoods:stockgoods,
    //     //     pricegoods:pricegoods,
    //     //     formdeskripsi:formdeskripsi,
    //     //     // fotobarang:fotobarang,
    //     //     kategoribarang:kategoribarang,
    //     // },
    //     // success:function(isi)
    //     // {
    //     //     $('#example').DataTable().ajax.reload();
    //     //     alert('Save Success');
    //     // },
    //     // error:function(err){
    //     //     alert(err);
    //     //     alert("err");
    //     // }
    //     // });

    //     $.ajax({
    //     url: "../ajax/inventory/codeaddbarang.php",
    //     type:"post",
    //     data:{
    //         form_data,
    //     },
    //     contentType: false,
    //     processData: false,
    //     success:function(isi)
    //     {
    //         // $('#example').DataTable().ajax.reload();
    //         alert('Save Success');
    //         alert(isi);
    //     },
    //     error:function(err){
    //         alert(err);
    //         alert("err");
    //     }
    //     });
    // });

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