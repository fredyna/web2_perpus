<?php
    require_once('header.php');
    require_once('navbar.php');
?>

<!-- Content -->
<div class="px-content">
  <div class="page-header">
    <h1><i class="px-nav-icon ion-home"></i><span class="px-nav-label"></span>BERANDA</h1>
  </div>

    <div class="row">
        <div class="col-sm-12">
        <div class="panel">
            <div id="judul_form" class="panel-title">Halaman Beranda</div>
                <small class="panel-subtitle text-muted"></small>
                <div class="panel-body">
                    Selamat datang di web perpustakaan kami.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content -->

<script>
    $(function(){
        $("#menu-beranda").addClass('active');
    });
</script>

<?php
    require_once('footer.php');
?>