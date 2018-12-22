<?php 

    require_once('../controller/KategoriController.php');
    $id = $_POST['id'];

    $kategori = new KategoriController();
    $kategori->getById($id);

?>