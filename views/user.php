<?php
    require_once('header.php');
    require_once('navbar.php');
    require_once('controller/UsersController.php');

    $user = new UsersController();
    $data = $user->getAll();
?>

<!-- Content -->
<div class="px-content">
  <div class="page-header">
    <h1><i class="px-nav-icon ion-home"></i><span class="px-nav-label"></span>USER</h1>
  </div>

    <div class="row">
        <div class="col-sm-12">
        <div class="panel">
            <div id="judul_form" class="panel-title">Data User</div>
                <small class="panel-subtitle text-muted">Tabel Data User</small>
                <div class="panel-body">
                    <button id="btn-add" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">Tambah Data</button>
                    <br /><br />
                    <div class="table-success">
                        <table id="table-user" class="table table-bordered table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="body-table-user">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- end row -->

</div>
<!-- content -->

<!-- modal form -->
    <div id="modal-form" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Form Tambah Data User</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" method="post">
                    <!-- hidden input id -->
                    <input type="hidden" id="id" name="id" style="display:none;">

                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-7">
                                <input type="text" id="username" placeholder="Masukan username" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" id="nama" placeholder="Masukan nama" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-7">
                                <input type="email" id="email" placeholder="Masukan email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-7">
                                <input type="password" id="password" placeholder="Masukan ulang password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Repeat Password</label>
                            <div class="col-sm-7">
                                <input type="password" id="r-password" placeholder="Masukan ulang password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="row">
                            <div class="col-sm-10">
                                <button type="button" id="btn-simpan" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
                                <button type="button" id="btn-update" class="btn btn-primary" style="display:none;"><i class="fa fa-edit"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- end modal form -->

<script>
    //get data using datatables server side
    var table = $('#table-user').DataTable( { 
        "processing": true,
        "serverSide": true,
        "ajax": "views/user_getData.php",
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<center><button type='button' class='btn btn-info btn-xs tblEdit'><i class='fa fa-edit'></i></button> <button type='button' class='btn btn-danger btn-xs tblHapus'><i class='fa fa-trash'></i></button></center>"
        }]
    });

    $(function(){
        $("#menu-user").addClass('active');

        $("#btn-add").click(function(){
            clearForm();
            $("#btn-update").hide();
            $("#btn-simpan").show();
        });

        //get data by id
        $('#table-user tbody').on( 'click', '.tblEdit', function () {
            var data = table.row( $(this).parents('tr') ).data();

            $.ajax({
                url: 'views/user_edit.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': data[0]
                }
            }).done(function(data){
                $("#modal-form").modal('show');
                clearForm();
                $("#id").val(data[0].id);
                $("#nama").val(data[0].nama);
                $("#email").val(data[0].email);
                $("#username").val(data[0].usernames);
                $("#password").val("");
                $("#r-password").val("");

                $("#btn-simpan").hide();
                $("#btn-update").show();
                
            }).fail(function(jqXHR, textStatus){
                swal("Gagal", "Error : "+textStatus, "error");
            });
        } );

        //hapus data
        $('#table-user tbody').on( 'click', '.tblHapus', function () {
            var data = table.row( $(this).parents('tr') ).data();

            swal({
                title: "Apakah Anda yakin?",
                text: "Data yang dipilih akan terhapus!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    deleteUser(data[0]);
                } else {
                    swal("Data gagal dihapus!",{
                        icon: "error",
                    });
                }
            });
        } );

        //simpan data
        $("#btn-simpan").click(function(){
            if($("#password").val() != $("#r-password").val()){
                swal("Gagal", "Kolom Repeat Password tidak sama!", "error");
                return;
            }

            if($("#password").val() == ""){
                swal("Gagal", "Password harus diisi", "error");
                return;
            }

            if($("#username").val() == ""){
                swal("Gagal", "Username harus diisi", "error");
                return;
            }

            if($("#nama").val() == ""){
                swal("Gagal", "Nama harus diisi", "error");
                return;
            }


            if($("#email").val() == ""){
                swal("Gagal", "Email harus diisi", "error");
                return;
            }

            var user = {
                nama: $("#nama").val(),
                email: $("#email").val(),
                usernames: $("#username").val(),
                password: $("#password").val()
            }

            user = JSON.stringify(user);

            $.ajax({
                url: 'views/user_proses.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'action': 'simpan',
                    'data': user
                }
            }).done(function(data){
                if(data){
                    clearForm();
                    
                    swal("Sukses", "Data berhasil ditambahkan!", "success");
                    table.ajax.reload(null, false);
                } else{
                    swal("Gagal", "Data gagal ditambahkan!", "error");
                }
                
            }).fail(function(jqXHR, textStatus){
                swal("Gagal", "Error : "+textStatus, "error");
            });
        });

        //update data
        $("#btn-update").click(function(){
            if($("#password").val() != $("#r-password").val()){
                swal("Gagal", "Kolom Repeat Password tidak sama!", "error");
                return;
            }

            if($("#username").val() == ""){
                swal("Gagal", "Username harus diisi", "error");
                return;
            }

            if($("#nama").val() == ""){
                swal("Gagal", "Nama harus diisi", "error");
                return;
            }


            if($("#email").val() == ""){
                swal("Gagal", "Email harus diisi", "error");
                return;
            }

            var id = $("#id").val();
            var user = {
                nama: $("#nama").val(),
                email: $("#email").val(),
                usernames: $("#username").val(),
                password: $("#password").val()
            }

            user = JSON.stringify(user);

            $.ajax({
                url: 'views/user_proses.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'action': 'update',
                    'id': id,
                    'data': user
                }
            }).done(function(data){
                if(data){
                    clearForm();
                    $("#modal-form").modal('hide');
                    swal("Sukses", "Data berhasil perbarui!", "success");
                    table.ajax.reload(null, false);
                } else{
                    swal("Gagal", "Data gagal diperbarui!", "error");
                }
                
            }).fail(function(jqXHR, textStatus){
                swal("Gagal", "Error : "+textStatus, "error");
            });
        });
    });

    function clearForm(){
        $("#nama").val("");
        $("#email").val("");
        $("#username").val("");
        $("#password").val("");
        $("#r-password").val("");

        $("#username").focus();
    }

    function deleteUser(id){
        $.ajax({
            url: 'views/user_hapus.php?id='+id,
            type: 'GET',
            dataType: 'json',
        }).done(function(data){
            if(data){
                table.ajax.reload(null, false);
                swal("Sukses", "Data berhasil terhapus!", "success");
            } else{
                swal("Gagal", "Data gagal dihapus!", "error");
            }
            
        }).fail(function(jqXHR, textStatus){
            swal("Gagal", "Error : "+textStatus, "error");
        });
    }

    
</script>

<?php
    require_once('footer.php');
?>