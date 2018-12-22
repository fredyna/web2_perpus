<?php

    require_once('../controller/KategoriController.php');
    $kategori = new KategoriController();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $kategori->delete($id);
    } else{
        $result = false;
        echo json_encode($result);
    }

?>