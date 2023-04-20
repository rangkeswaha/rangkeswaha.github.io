<!DOCTYPE html>
<html>
<?php 
session_start();
include "../import.php"; ?>
<link rel="stylesheet" href="tambahbarang.css">
<script>

    function getbarang() {
		$.ajax({
			url: "../ajax/inventory/codegetbarang.php",
			success:function(isi)
			{
				var data = JSON.parse(isi);

                // alert(data[1].harga_barang);
                var str = '';
                for (var i = 0; i < data.length; i++){
                    str += '<tr><td>'+data[i].nama_barang+'</td>'+
                    '<td>'+data[i].harga_barang+'</td>'+
                    '<td>'+data[i].stok_barang+'</td></tr>';
                }

                $("#listbarang").html(str);

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
    });
    document.onload = function () {
        getallkategorioption();
    };
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
            <div class="page-title">
                <h3>Tambah Barang</h3>
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
                    <form action="../ajax/inventory/codeaddbarangfix.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label" style="font-size:20px; font-weight: bold; margin-bottom: 1%; margin-top: 1%;">Data Barang</label>
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
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <!-- BEGIN TAG INPUTS / FILE UPLOADER CONTROLS-->
                                    <label class="form-label">Gambar Barang</label>
                                    <div class="fallback">
                                        <input id="fotobarang" accept="image/*" name="fotobarang" type="file"/>
                                    </div>
                                    <!-- END TAG INPUTS / FILE UPLOADER CONTROLS-->
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="pull-right">
                                <button type="submit" id="savebarangbutton" name="savebarangbutton" class="btn btn-danger btn-cons"><i class="icon-ok"></i>
                                SAVE</button>
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