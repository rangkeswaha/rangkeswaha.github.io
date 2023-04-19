<?php 
    session_start(); 
  ?>
<!DOCTYPE html>
<html>

<?php include "../import.php"; ?>

<!-- END HEAD -->
<!-- BEGIN BODY -->
<script>
    // var loginId = "<?php 
    // echo $loginId; ?>";
    function refreshTable(){
        $('#example').DataTable( {
            responsive: true,
            "ajax": {
                "url": "../ajax/masterkategori/getallkategori.php",
                "dataSrc": ""
            },
            "columns": [
                { "data": "kategori" },
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html2 = "<td> <button id='"+row.kategori+"_"+row.key+"' class='btn btn-info editmasterkategori'></i>Edit</button></td>";
                        return html2;
                    }
                },
                { "render": function (data, type, row, meta) { // Tampilkan kolom aksi
                        var html1  = "<td> <buttton id='"+row.kategori+"_"+row.key+"' class='btn btn-danger deletemasterkategori'>Delete</button></td>";
                        return html1;
                    }
                },
            ]
        });
    }

    var kategoriawal;
    var keyawal;
    var modal;
    $(document).on("click",".editmasterkategori",function(){
        var selected = this;
        var id = this.id;

        var split = id.split("_");

        // alert(split);

        kategoriawal = split[0];
        keyawal = split[1];
        // alert(kategoriawal);


        modal = document.getElementById("myModal");
        modal.style.display = "block";

        // $("#formeditkategori").attr("value", "");
        // $("#formeditkategori").attr("value", kategoriawal);
        document.getElementById('formeditkategori').value = kategoriawal;

        // alert(kategoriawal);
    });

    // // Get the modal
    // var modal = document.getElementById("myModal");

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


    $(document).on("click",".deletemasterkategori",function(){
        var selected = this;
        var id = this.id;
        // alert(id);

        var split = id.split("_");

        // alert(split);

        kategoriawal = split[0];
        keyawal = split[1];

        // AJAX Request
        let confirmAction = confirm("Data Data Akan Dihapus?");
        if (confirmAction) {
            $.ajax({
                url: '../ajax/masterkategori/deletekategori.php',
                type: 'POST',
                data: { keyawal:keyawal,},
                success: function(response){
                    alert('Kategori Telah Dihapus');
                    $('#example').DataTable().ajax.reload();
                },
                error: function(a, err){
                    //lakukan sesuatu untuk handle error
                    alert("Gagal delete");
                }
            });
        }
    });


    $(document).ready(function(){
        refreshTable();
        // getallpegawai();
        // getallstatus();
        // // alert("masuk");
        // $("#myInput").on("keyup", function() {
        //     var value = $(this).val().toLowerCase();
        //     $("tbody tr").filter(function() {
        //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //     });
        // });
    });
</script>

<body class="">
    <!-- begin header -->
    <?php include "../header.php"; ?>
    <!-- end header -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- begin sidebar -->
        <?php include "../sidebar.php"; ?>
        <!-- end sidebar -->
        <!-- BEGIN PAGE CONTAINER-->
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="content">
                <div class="page-title">
                    <h3>Data Master - <span class="semi-bold">Kategori</span></h3>
                </div>
                <div class="grid simple form-grid">
                    <div class="grid-body no-border">
                        <br>
                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span onclick="closeModal()" class="closeModal">&times;</span>
                                <h3>EDIT KATEGORI</h3>
                                <br><br>
                                <div id="modalBody">
                                    <div class="form-group">
                                        <div class="row form-row">
                                            <div class="col-md-8">
                                                    <label>Kategori</label>
                                                    <input name="formeditkategori"  id="formeditkategori" type="text"
                                                        class="form-control" placeholder="Kategori" value="">
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <button type="button" id="editkategori" class="btn btn-success btn-cons"><i class="icon-ok"></i>
                                                Save</button>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <form id="form_insert_masterOrganisasi" action="#">
                            <div class="form-group">
                                <label class="form-label">Kategori Barang</label>
                                <div class="input-with-icon  right">
                                    <i class=""></i>
                                    <input type="text" placeholder="Makanan Segar" name="formkategori" id="formkategori" class="form-control">
                                </div>
                            </div>
                        </form> -->
                        <form id="form_insert_masterOrganisasi" action="#">
                            <div class="form-group">
                                <label class="form-label">Kategori Barang</label>
                                <div class="input-with-icon  right">
                                    <i class=""></i>
                                    <input type="text" placeholder="Makanan Segar" name="formkategori" id="formkategori" class="form-control">
                                </div>
                            </div>
                            <!-- BEGIN PAGE CONTAINER-->
                            <div class="form-actions">
                                <div class="pull-right">
                                    <button type="button" id="tambah" class="btn btn-danger btn-cons"><i class="icon-ok"></i>
                                        Save</button>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                            $("#tambah").click(function(){
                                var formkategori = $("#formkategori").val();

                                // alert(formkategori);
                                
                                if(formkategori != ""){
                                    $.ajax({
                                        url:"../ajax/masterkategori/addkategori.php",
                                        type:"post",
                                        data:{
                                            formkategori:formkategori,
                                        },
                                        success:function(res){
                                            alert(res);
                                            $('#example').DataTable().ajax.reload();
                                            // $("#formMLoginPass").val("");
                                            // getallpegawai();
                                            // window.location.replace("mastertipelogin.php");
                                        },
                                        error:function(err){
                                            alert(err);
                                        }
                                    });
                                }
                            });
                            $("#editkategori").click(function(){
                                var formeditkategori = $("#formeditkategori").val();

                                // alert(formeditkategori);

                                let confirmAction = confirm("Apakah Data Akan Diganti?");
                                if (confirmAction) {
                                    if(formeditkategori != ""){
                                        $.ajax({
                                            url:"../ajax/masterkategori/editkategori.php",
                                            type:"post",
                                            data:{
                                                formeditkategori:formeditkategori,
                                                kategoriawal:kategoriawal,
                                                keyawal:keyawal,
                                            },
                                            success:function(res){
                                                alert(res);
                                                closeModal();
                                                document.getElementById('formeditkategori').value = "";
                                                $('#example').DataTable().ajax.reload();
                                                // $("#formMLoginPass").val("");
                                                // getallpegawai();
                                                // window.location.replace("mastertipelogin.php");
                                            },
                                            error:function(err){
                                                alert(err);
                                            }
                                        });
                                    }
                                } else {
                                    closeModal();
                                }
                            });
                        </script>
                        <br><br>
                        <h3>Tabel <span class="semi-bold">Master Kategori</span></h3>
                        <!-- <p>Type something in the input field to search the table value</p>  
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">   -->
                        <br>
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Kategori Barang</th>
                                    <!-- <th>Status</th> -->
                                    <!-- <th>Last Login</th> -->
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Chat -->
        <?php include "../chat.php"; ?>
    </div>
    <!-- END CONTAINER -->
    
    <!-- END CONTAINER -->
    
</body>

</html>

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