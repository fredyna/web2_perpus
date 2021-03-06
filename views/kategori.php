<?php
    require_once('header.php');
    require_once('navbar.php');
?>

<!-- Content -->
<div class="px-content">
  <div class="page-header">
    <h1><i class="px-nav-icon ion-home"></i><span class="px-nav-label"></span>KATEGORI</h1>
  </div>

    <div class="row">
        <div class="col-sm-12">
        <div class="panel">
            <div id="judul_form" class="panel-title">Data kategori</div>
                <small class="panel-subtitle text-muted">Tabel Data kategori</small>
                <div class="panel-body">
                    <button id="btn-add" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">Tambah Data</button>
                    <br /><br />
                    <div class="table-success">
                        <table id="table-kategori" class="table table-bordered table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KATEGORI</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="body-table-kategori">
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
                <h4 class="modal-title">Form Tambah Data Kategori Buku</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" method="post">
                    <!-- hidden input id -->
                    <input type="hidden" id="id"  name="id" style="display:none;">

                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Kategori</label>
                            <div class="col-sm-7">
                                <input type="text" id="kategori" placeholder="Masukan kategori" class="form-control" required>
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
    var table = $('#table-kategori').DataTable( { 
        "processing": true,
        "serverSide": true,
        "ajax": "views/kategori_getData.php",
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<center><button type='button' class='btn btn-info btn-xs tblEdit'><i class='fa fa-edit'></i></button> <button type='button' class='btn btn-danger btn-xs tblHapus'><i class='fa fa-trash'></i></button></center>"
        }]
    });

    $(function(){
        $("#menu-kategori").addClass('active');

        $("#btn-add").click(function(){
            clearForm();
            $("#btn-update").hide();
            $("#btn-simpan").show();
        });

        //get data by id
        $('#table-kategori tbody').on( 'click', '.tblEdit', function () {
            var data = table.row( $(this).parents('tr') ).data();

            $.ajax({
                url: 'views/kategori_edit.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'id': data[0]
                }
            }).done(function(data){
                $("#modal-form").modal('show');
                clearForm();
                $("#id").val(data[0].id);
                $("#kategori").val(data[0].kategori);

                $("#btn-simpan").hide();
                $("#btn-update").show();
                
            }).fail(function(jqXHR, textStatus){
                swal("Gagal", "Error : "+textStatus, "error");
            });
        } );

        //hapus data
        $('#table-kategori tbody').on( 'click', '.tblHapus', function () {
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
                    deleteKategori(data[0]);
                } else {
                    swal("Data gagal dihapus!",{
                        icon: "error",
                    });
                }
            });
        } );

        //simpan data
        $("#btn-simpan").click(function(){

            if($("#kategori").val() == ""){
                swal("Gagal", "Kategori harus diisi", "error");
                return;
            }

            var kat = {
                kategori: $("#kategori").val()
            }

            kat = JSON.stringify(kat);

            $.ajax({
                url: 'views/kategori_proses.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'action': 'simpan',
                    'data': kat
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

            if($("#kategori").val() == ""){
                swal("Gagal", "Kategori harus diisi", "error");
                return;
            }


            var id = $("#id").val();
            var kat = {
                kategori: $("#kategori").val()
            }

            kat = JSON.stringify(kat);

            $.ajax({
                url: 'views/kategori_proses.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'action': 'update',
                    'id': id,
                    'data': kat
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
        $("#kategori").val("");

        $("#kategori").focus();
    }

    function deleteKategori(id){
        $.ajax({
            url: 'views/kategori_hapus.php?id='+id,
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