<?php
    session_start();

    require_once('google-calendar-api.php');
    require_once('settings.php');

    
    $ceklogin = 0;
    $login_url = "";
    if(!isset($_SESSION['access_token'])) {
        $login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/calendar') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';
        $ceklogin = 1;
    }
    
?>

<!DOCTYPE html>
<html>
<?php 
include "../import.php"; ?>
<link rel="stylesheet" href="../inventory/tambahbarang.css">

<style>
    
</style>

<script>

    $(document).ready(function(){
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});

        // Retrieve the string from session storage and convert it back to an array
        var myArrayString = sessionStorage.getItem('allneworder');
        var allneworder = JSON.parse(myArrayString);

        // alert(allneworder[0].namegoods);
        // alert(allneworder[0].stockgoods);
        // alert(allneworder[1].namegoods);
        // alert(allneworder[1].stockgoods);

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
                <li><a href="/skripsi/apps/distribusi/pesanan.php" class="#">Pilih Tempat</a> </li>
                <li><a href="/skripsi/apps/distribusi/pilihbarang.php" class="#">Pilih Barang</a> </li>
                <li><a href="/skripsi/apps/distribusi/catatanbarang.php" class="active">Tambah Catatan</a> </li>
            </ul>
            <div class="page-title">
                <h3>Pengiriman - <span class="semi-bold">Tambah Catatan</span></h3>
            </div>
            <div class="grid simple form-grid">
                <div class="grid-body no-border" style="border-radius: 10px;">
                    <br>
                    <form id="">
                        <div class="form-group">
                            <label class="form-label" style="font-size: 25px; font-weight: bold; margin-top: 1%;">Catatan Pengiriman</label>
                            <label for="content" style="font-size: 12px; color: #333; margin-bottom: 10px;">(Tulis jika ada)</label>
                            <br><br>
                            <div class="row form-row">
                                <div class="col-md-12" style="background-color: #f2f2f2; font-family: Arial, sans-serif; margin: 0 auto; max-width: 100%; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.2); border-radius: 5px;">
                                    <form style=": flex; flex-direction: column; align-items: center;">
                                        <textarea id="content" name="content" placeholder="Enter note content..." style="width: 100%; height: 200px; padding: 10px; margin-bottom: 10px; border: none; border-radius: 5px; box-shadow: 0 0 5px rgba(0,0,0,0.2); resize: none;"></textarea>
                                        <!-- <center>
                                            <button id="add-note" style="background-color: #3880ce; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Tambah Catatan</button>
                                        </center> -->
                                    </form>
                                    <ul id="notes" style="list-style: none; padding: 0; margin: 0;">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="pull-right">
                                <button type="button" id="saveNote" name="saveNote" style="border-radius: 5px; margin-bottom: 15px; background-color: #53a551; color: white;" class="btn btn-cons"><i class="icon-ok"></i>
                                Lanjut Transaksi</button>
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
    const form = document.querySelector('form');
    const notesList = document.querySelector('#notes');
    const savenote = document.querySelector('#saveNote');
    // const addNoteButton = document.querySelector('#add-note');
    
    // addNoteButton.addEventListener('click', (e) => {
    //     e.preventDefault();
        
    //     const content = document.querySelector('#content').value;
        
    //     if (content.trim() === '') {
    //         alert('Please enter content for your note.');
    //         return;
    //     }
        
    //     const note = document.createElement('li');
    //     note.innerHTML = `
    //         <div style="background-color: #fff; padding: 20px; margin-bottom: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.2); border-radius: 5px; font-size: 18px; line-height: 1.5; margin: 0; word-wrap: break-word;">${content}</div>
    //         <button style="background-color: #f44336; color: #fff; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Hapus</button>
    //         <br><br>
    //     `;
        
    //     notesList.appendChild(note);
        
    //     document.querySelector('#content').value = '';
        
    //     note.querySelector('button').addEventListener('click', () => {
    //         note.remove();
    //     });
    // });

    savenote.addEventListener('click', (e) => {
        e.preventDefault();

        <?php
            // $access_token = $_SESSION['access_token'];
        ?>
        
        // alert(access_token);
        
        if(<?php echo $ceklogin; ?> == 1){
            // alert("Login Akun Google Berhasil Silahkan Lanjutkan Transaksi");
            // window.location.href = "<?php echo $login_url; ?>";
            alert("Login Akun Google Terlebih Dahulu");
            window.location.href = "/skripsi/apps/distribusi/google-login.php";
            window.close();
        }else {
            // content note (catatan)
            var content = document.querySelector('#content').value;
            
            if (content.trim() === '') {
                content = "";
            }

            // attribute tempat distribusi
            var diskey = sessionStorage.getItem('diskey');
            var disnama = sessionStorage.getItem('disnama');
            var disfoto = sessionStorage.getItem('disfoto');
            var disalamat = sessionStorage.getItem('disalamat');
            var disdeskripsi = sessionStorage.getItem('disdeskripsi');
            var disdetailaddress = sessionStorage.getItem('disdetailaddress');
            var dislatitude = sessionStorage.getItem('dislatitude');
            var dislongitude = sessionStorage.getItem('dislongitude');

            // attribute untuk pembelian
            var allneworder = JSON.parse(sessionStorage.getItem('allneworder'));

            // var output = "";

            // for (var i = 0; i < allneworder.length; i++) {
            // output += "{ name: \"" + allneworder[i].namegoods + "\", price: " + allneworder[i].pricegoods + " }\n";
            // }

            // alert(output);

            // var dataorder = { allneworder: JSON.stringify(allneworder) };
            
            //to check data in the object
            // alert(JSON.stringify(allneworder));
            // alert(allneworder[0].namegoods);
            // alert(allneworder[1].namegoods);

            var descriptionvalue = "Barang - barang yang dikirim: \n";
            for (var i = 0; i < allneworder.length; i++){
                // alert(allneworder[i].namegoods);
                var number = i + 1;
                descriptionvalue += number.toString() + " " + allneworder[i].namegoods + " " + allneworder[i].stockgoods.toString() + "kg" + "\n";
            }
            if (content != ""){
                descriptionvalue += "\nCatatan Pengiriman\n" + content;

            }
            // alert(descriptionvalue);

            var endtimevalue = sessionStorage.getItem("endtime");
            var stattimevalue = sessionStorage.getItem("starttime");

            // alert(stattimevalue);
            // alert(endtimevalue);


            // // Event details //
            parameters = { 	title: "Pengiriman Barang di " + disnama,
                            location: disdetailaddress,
                            description: descriptionvalue,
                            event_time: {
                                start_time: stattimevalue,
                                end_time: endtimevalue,
                                event_date: null
                            },
                            all_day: 0,
                        };

            $.ajax({
                type: 'POST',
                url: '../ajax/distribusi/codeaddpengiriman.php',
                data: { notegoods:content,
                        diskey:diskey,
                        disnama:disnama,
                        disfoto:disfoto,
                        disalamat:disalamat,
                        disdeskripsi:disdeskripsi,
                        disdetailaddress:disdetailaddress,
                        dislatitude:dislatitude,
                        dislongitude:dislongitude,
                        parameters: JSON.stringify(parameters),
                        dataorder: JSON.stringify(allneworder),},
                success: function(response) {
                    // alert(response);
                    // alert('Event created with ID : ' + response.event_id);
                    alert("Pesanan Berhasil Dibuat");
                    // alert(response);
                    window.location.href = "pesanan.php";
                    // allnewstock.length = 0;
                    // var str = "";
                    // $("#tablegoods").html(str);
                    // // Reload the current page
                    // location.reload();
                },
                error: function(a, err){
                    //lakukan sesuatu untuk handle error
                    alert("Data Gagal Disimpan");
                    alert("Error: " + err);
                    // alert(err.responseJSON.message);
                },
            });
        }


        
        // const note = document.createElement('li');
        // alert(content);
        // note.innerHTML = `
        //     <div style="background-color: #fff; padding: 20px; margin-bottom: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.2); border-radius: 5px; font-size: 18px; line-height: 1.5; margin: 0; word-wrap: break-word;">${content}</div>
        //     <button style="background-color: #f44336; color: #fff; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Hapus</button>
        //     <br><br>
        // `;
        
        // notesList.appendChild(note);
        
        // document.querySelector('#content').value = '';
        
        // note.querySelector('button').addEventListener('click', () => {
        //     note.remove();
        // });
    });
</script>

<script>

    // $('#saveTempat').click(function(){
    //     //to grab longitude, latitude and detail address
    //     // Get the address input element
    //     const addressInput = document.getElementById('address-input');

    //     // Geocode the entered address
    //     geocoder.geocode({ address: addressInput.value }, (results, status) => {
    //         if (status === 'OK') {
    //         // Center the map on the geocoded location
    //         map.setCenter(results[0].geometry.location);
    //         map.setZoom(16);

    //         // Remove any existing marker from the map
    //         if (marker) {
    //             marker.setMap(null);
    //         }

    //         // Create a new marker at the geocoded location
    //         marker = new google.maps.Marker({
    //             map: map,
    //             position: results[0].geometry.location,
    //             draggable: true
    //         });

    //         // When the user drags the marker, update the address input with the new location
    //         marker.addListener('dragend', () => {
    //             geocoder.geocode({ location: marker.getPosition() }, (results, status) => {
    //                 if (status === 'OK') {
    //                     if (results[0]) {
    //                     document.getElementById('address-input').value = results[0].formatted_address;
    //                     }
    //                 }
    //             });
    //         });

    //         // Get the latitude, longitude, and formatted address of the geocoded location
    //         const latitude = results[0].geometry.location.lat();
    //         const longitude = results[0].geometry.location.lng();
    //         const formattedAddress = results[0].formatted_address;

    //         // Display the latitude, longitude, and formatted address in an alert
    //         // alert(`Latitude: ${latitude}\nLongitude: ${longitude}\nAddress: ${formattedAddress}`);

    //         savelatitude = latitude;
    //         savelongitude = longitude;
    //         savedetail_address = formattedAddress;

    //         var nama = $("#namePlace").val();
    //         var alamat = $("#addressPlace").val();
    //         var deskripsi = $("#deskripsiTempat").val();
    //         var foto = $("#fotoTempat")[0].files;
        

    //         var form_data = new FormData();
    //         form_data.append("nama", nama);
    //         form_data.append("alamat", alamat);
    //         form_data.append("deskripsi", deskripsi);
    //         form_data.append("namafoto", foto[0]);
    //         form_data.append("savelatitude", savelatitude);
    //         form_data.append("savelongitude", savelongitude);
    //         form_data.append("savedetail_address", savedetail_address);

    //         $.ajax({
    //             url:"../ajax/tempatdistribusi/addtempatdis.php",
    //             type:"post",
    //             data:form_data,
    //             contentType: false,
    //             processData: false,
    //             success:function(res){
    //                 // console.log(res);
                    
    //                 // alert(res);

    //                 alert("Data Tempat Telah Disimpan");

    //                 $('#example').DataTable().ajax.reload();
    //                 // window.location.replace("profile.php");
    //             },
    //             error:function(err){
    //                 alert(err);
    //                 alert("err");
    //             }
    //         });
    //         } else {
    //             alert('Masukan Alamat');
    //         }
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