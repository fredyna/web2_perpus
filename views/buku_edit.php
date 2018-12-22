<?php 

    require_once('../controller/BooksController.php');
    $id = $_POST['id'];

    $buku = new BooksController();
    $buku->getById($id);

?>