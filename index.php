<?php
    // header('Location: views/umum/');
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        switch($page){
            case 'home':
                include('views/index.php'); 
            break;
            case 'user': 
                include('views/user.php');
            break;
            case 'kategori';
                include('views/kategori.php');
            break;
            case 'buku';
                include('views/buku.php');
            break;
            default: 
                include('page404.php'); 
            break;
        }
        die();
    }
    include('views/index.php');
?>