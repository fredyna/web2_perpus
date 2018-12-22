<?php

    require_once('../controller/BooksController.php');
    $buku = new BooksController();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $buku->delete($id);
    } else{
        $result = false;
        echo json_encode($result);
    }

?>